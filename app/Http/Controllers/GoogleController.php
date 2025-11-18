<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Email;
use App\Models\Media;
use App\Models\Meeting;
use App\Models\MeetingMinute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Google\Client as GoogleClient;
use Google\Service\Calendar as GoogleCalendar;

use Google\Service\Calendar\EventDateTime as GoogleEventDateTime;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;

class GoogleController extends Controller
{
        public function index()
    {
        $userId = auth()->id();

        $emails = Email::with('receiver')->where('receiver_id', $userId)->get();
        $media = Media::where('user_id', $userId)->get();
        $users = User::get();

        $meetings = [];


            // Also get meetings from database
            $dbMeetings = Meeting::with(['user', 'participants', 'meeting_minute'])
                ->where('user_id', $userId)
                ->orWhereHas('participants', function($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
                ->get();

            foreach ($dbMeetings as $dbMeeting) {
                $meetings[] = $this->formatDatabaseMeeting($dbMeeting);
            }

        return view('pages.meeting', compact('emails', 'media', 'meetings', 'users'));
    }
        protected function getClient()
    {
        $client = new \Google\Client();

        

        $client->setClientId(config('services.google_meet.client_id_meet'));
        $client->setClientSecret(config('services.google_meet.client_secret_meet'));
        $client->setRedirectUri(config('services.google_meet.redirect_uri_meet'));

        // ✅ Required settings
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        $client->setScopes([Calendar::CALENDAR_EVENTS]);

        return $client;
    }

    /**
     * Step 1: Redirect user to Google OAuth fsdfsfs
     */
    public function redirectToGoogle(Request $request)
    {
        // ✅ Save form data to session for later use
        if ($request->has(['title', 'start', 'end'])) {
            session(['meeting_data' => $request->only(['title', 'start', 'end', 'attendees'])]);
        }

        $client = $this->getClient();
        return redirect($client->createAuthUrl());
    }

    /**
     * Step 2: Handle Google OAuth Callback
     */
    public function handleGoogleCallback(Request $request)
    {
         
        $client = $this->getClient();
        $token = $client->fetchAccessTokenWithAuthCode($request->code);

        if (isset($token['error'])) {
            return redirect()->route('dashboard')->with('error', 'Google authentication failed.');
        }
        
        // ✅ Preserve refresh token (if missing)
        if (!isset($token['refresh_token'])) {
            
            $oldToken = json_decode(auth()->user()->google_token ?? '', true);
            if (isset($oldToken['refresh_token'])) {
                $token['refresh_token'] = $oldToken['refresh_token'];
            }
        }
        //  dd($token);

        // ✅ Save token in user table
        auth()->user()->update(['google_token' => json_encode($token)]);

        // ✅ If meeting data was waiting, create it now
        if (session()->has('meeting_data')) {
            $data = session('meeting_data');
            session()->forget('meeting_data');
            return $this->createMeeting(new Request($data));
        }

        return redirect()->route('dashboard')->with('success', 'Google connected successfully!');
    }


public function createMeeting(Request $request)
{
    // Merge date + time into start_time
    if ($request->filled('meeting_date') && $request->filled('meeting_time')) {
        $request->merge([
            'start_time' => $request->meeting_date . ' ' . $request->meeting_time
        ]);
    }

    // Validate
    $data = $request->validate([
        'topic' => 'required|string',
        'start_time' => 'required|date',
        'duration' => 'required|integer',
        'user_ids' => 'nullable|array',
        'agenda' => 'nullable|string',
        'documents.*' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg,zip|max:5120', // multiple files
    ]);

    // Handle multiple files
    $filePaths = [];
    if ($request->hasFile('documents')) {
        foreach ($request->file('documents') as $file) {
            $filePaths[] = $file->store('meetings', 'public');
        }
    }

    // Combine all file names in one column as JSON
    $documentsJson = !empty($filePaths) ? json_encode($filePaths) : null;

    // Calculate start & end time
    $start = new \DateTime($data['start_time']);
    $end = (clone $start)->modify("+{$data['duration']} minutes");

    // Map attendees emails
    $attendees = [];
    if (!empty($data['user_ids'])) {
        $attendees = \App\Models\User::whereIn('id', $data['user_ids'])->pluck('email')->toArray();
    }

    $meetingData = [
        'title' => $data['topic'],
        'start' => $start->format('Y-m-d\TH:i:s'),
        'end' => $end->format('Y-m-d\TH:i:s'),
        'attendees' => $attendees,
        'duration' => $data['duration'],
        'agenda' => $data['agenda'] ?? 'No Agenda',
        'documents' => $documentsJson, // save all files
    ];

    // --- Google Meet logic ---
    $rawToken = auth()->user()->google_token;
    $token = json_decode($rawToken, true);
    if (!is_array($token) || !isset($token['access_token'])) {
        session(['meeting_data' => $meetingData]);
        return response()->json(['redirect' => route('google.redirect')]);
    }

    $client = $this->getClient();
    $client->setAccessToken($token);
    if ($client->isAccessTokenExpired() && isset($token['refresh_token'])) {
        $newToken = $client->fetchAccessTokenWithRefreshToken($token['refresh_token']);
        $newToken['refresh_token'] = $token['refresh_token'];
        auth()->user()->update(['google_token' => json_encode($newToken)]);
        $client->setAccessToken($newToken);
    }

    $service = new \Google\Service\Calendar($client);

    $event = new \Google\Service\Calendar\Event([
        'summary' => $meetingData['title'],
        'start' => ['dateTime' => $meetingData['start'], 'timeZone' => config('app.timezone', 'Asia/Karachi')],
        'end' => ['dateTime' => $meetingData['end'], 'timeZone' => config('app.timezone', 'Asia/Karachi')],
    ]);

    if (!empty($meetingData['attendees'])) {
        $event->setAttendees(array_map(fn($email) => ['email' => $email], $meetingData['attendees']));
    }

    $conferenceData = new \Google\Service\Calendar\ConferenceData();
    $createRequest = new \Google\Service\Calendar\CreateConferenceRequest();
    $createRequest->setRequestId(uniqid('meet_', true));
    $conferenceData->setCreateRequest($createRequest);
    $event->setConferenceData($conferenceData);

    $createdEvent = $service->events->insert('primary', $event, ['conferenceDataVersion' => 1,
    'sendUpdates' => 'none' ]);

    $meetLink = null;
    $conf = $createdEvent->getConferenceData();
    if ($conf && $conf->getEntryPoints()) {
        foreach ($conf->getEntryPoints() as $ep) {
            if ($ep->getEntryPointType() === 'video') {
                $meetLink = $ep->getUri();
                break;
            }
        }
    }

    // Save meeting in DB
    $meeting = Meeting::create([
        'user_id' => auth()->id(),
        'google_event_id' => $createdEvent->getId(),
        'topic' => $meetingData['title'],
        'start_time' => $meetingData['start'],
        'duration' => $meetingData['duration'],
        'agenda' => $meetingData['agenda'],
        'meeting_url' => $meetLink,
        'document' => $documentsJson, // save all file paths as JSON
    ]);


if (!empty($data['user_ids'])) {
    // 1️⃣ Attach participants in DB
    $meeting->participants()->attach($data['user_ids']); 

    // 2️⃣ Get all participants
    $participants = \App\Models\User::whereIn('id', $data['user_ids'])->get();

    // 3️⃣ Collect names of all participants
    $participantNames = $participants->pluck('name')->toArray(); // array of names
    $participantNamesString = implode(', ', $participantNames); // convert to string

    // 4️⃣ Send meeting email to each participant
    foreach ($participants as $user) {
        \Mail::send('emails.meeting_invite', [
            'user_name' => $user->name,
            'topic' => $meeting->topic,
            'agenda' => $meeting->agenda,
            'start_time' => $meeting->start_time,
            'duration' => $meeting->duration,
            'meet_link' => $meeting->meeting_url,
            'meeting_id' => $meeting->id,
            'user_id' => $user->id,
            'all_participants' => $participantNamesString, // ✅ Pass all participants
        ], function($message) use ($user, $meeting) {
            $message->to($user->email)
                    ->subject('Meeting Invitation: ' . $meeting->topic);
        });
    }
}



    return response()->json([
        'eventId' => $createdEvent->getId(),
        'meetLink' => $meetLink ?? 'Generating...',
    ]);
}



//     public function createMeeting(Request $request)
// {
    
//     // Map the incoming request to the expected data structure
//     $data = $request->validate([
//         'topic' => 'required|string',
//         'start_time' => 'required|date',
//         'duration' => 'required|integer',
//         'user_ids' => 'nullable|array',
//         'agenda' => 'required|string',
//     ]);

//     // Calculate end time from start_time + duration (minutes)
//     $start = new \DateTime($data['start_time']);
//     $end = (clone $start)->modify("+{$data['duration']} minutes");

//     // Map attendees emails from user_ids
//     $attendees = [];
//     if (!empty($data['user_ids'])) {
//         $attendees = \App\Models\User::whereIn('id', $data['user_ids'])->pluck('email')->toArray();
//     }

//     $meetingData = [
//         'title' => $data['topic'],
//         'start' => $start->format('Y-m-d\TH:i:s'),
//         'end' => $end->format('Y-m-d\TH:i:s'),
//         'attendees' => $attendees,
//         "duration" => $data['duration'],
//         "agenda" => $data['agenda'] ?? 'No Agenda',
//     ];

//     $rawToken = auth()->user()->google_token;
//     $token = json_decode($rawToken, true);

//     // 🔒 Validate token format
//     if (!is_array($token) || !isset($token['access_token'])) {
//         session(['meeting_data' => $meetingData]);
//         return response()->json([
//             'redirect' => route('google.redirect')
//         ]);
//     }

//     $client = $this->getClient();

//     // $token = json_decode(auth()->user()->google_token ?? '', true);

//     // if (!$token) {
//     //     session(['meeting_data' => $meetingData]);
//     //     return response()->json([
//     //         'redirect' => route('google.redirect')
//     //     ]);
//     // }

//     // $client = $this->getClient();
//     $client->setAccessToken($token);

//     if ($client->isAccessTokenExpired() && isset($token['refresh_token'])) {
//         $newToken = $client->fetchAccessTokenWithRefreshToken($token['refresh_token']);
//         $newToken['refresh_token'] = $token['refresh_token'];
//         auth()->user()->update(['google_token' => json_encode($newToken)]);
//         $client->setAccessToken($newToken);
//     }

//     $service = new Calendar($client);

//     $event = new Event([
//         'summary' => $meetingData['title'],
//         'start' => [
//             'dateTime' => $meetingData['start'],
//             'timeZone' => config('app.timezone', 'Asia/Karachi'),
//         ],
//         'end' => [
//             'dateTime' => $meetingData['end'],
//             'timeZone' => config('app.timezone', 'Asia/Karachi'),
//         ],
//     ]);

//     if (!empty($meetingData['attendees'])) {
//         $event->setAttendees(array_map(fn($email) => ['email' => $email], $meetingData['attendees']));
//     }

//     $conferenceData = new \Google\Service\Calendar\ConferenceData();
//     $createRequest = new \Google\Service\Calendar\CreateConferenceRequest();
//     $createRequest->setRequestId(uniqid('meet_', true));
//     $conferenceData->setCreateRequest($createRequest);
//     $event->setConferenceData($conferenceData);

//     $createdEvent = $service->events->insert('primary', $event, ['conferenceDataVersion' => 1]);

//     $meetLink = null;
//     $conf = $createdEvent->getConferenceData();
//     if ($conf && $conf->getEntryPoints()) {
//         foreach ($conf->getEntryPoints() as $ep) {
//             if ($ep->getEntryPointType() === 'video') {
//                 $meetLink = $ep->getUri();
//                 break;
//             }
//         }
//     }
    

//     // Save meeting in DB
//     $meeting = Meeting::create([
//         'user_id' => auth()->id(),
//         'google_event_id' => $createdEvent->getId(),
//         'topic' => $meetingData['title'],
//         'start_time' => $meetingData['start'],
//         'duration' => $meetingData['duration'],

//         "agenda" => $meetingData['agenda'],
//         'meeting_url' => $meetLink,
//     ]);

//     // Attach participants
//     if (!empty($data['user_ids'])) {
//         $meeting->participants()->attach($data['user_ids']);
//     }

//     return response()->json([
//         'eventId' => $createdEvent->getId(),
//         'meetLink' => $meetLink ?? 'Generating...',
//     ]);
// }


    public function deleteMeeting($id)
{
    // dd("there");
    // Find meeting in DB
    $meeting = Meeting::findOrFail($id);

    // --- Google Calendar deletion ---
    $rawToken = auth()->user()->google_token;
    $token = json_decode($rawToken, true);

    if (!is_array($token) || !isset($token['access_token'])) {
        return response()->json(['error' => 'Google account not connected'], 400);
    }

    $client = $this->getClient();
    $client->setAccessToken($token);

    // Refresh token if expired
    if ($client->isAccessTokenExpired() && isset($token['refresh_token'])) {
        $newToken = $client->fetchAccessTokenWithRefreshToken($token['refresh_token']);
        $newToken['refresh_token'] = $token['refresh_token'];
        auth()->user()->update(['google_token' => json_encode($newToken)]);
        $client->setAccessToken($newToken);
    }

    $service = new \Google\Service\Calendar($client);

    try {
        $service->events->delete('primary', $meeting->google_event_id);
    } catch (\Google\Service\Exception $e) {
        // Handle error if event already deleted or invalid
        \Log::error("Google Calendar delete error: " . $e->getMessage());
    }

    // --- Delete from DB ---
    $meeting->participants()->detach(); // remove participants relation if exists
    $meeting->delete();

    return redirect()->back()->with('success', 'Meeting deleted successfully.');
}


private function formatDatabaseMeeting($meeting)
{
    $startTime = Carbon::parse($meeting->start_time);
    $endTime = $startTime->copy()->addMinutes($meeting->duration);
    $now = Carbon::now(config('app.timezone', 'Asia/Karachi'));

    if ($meeting->cancelled_at) {
        $status = 'cancelled';
    } elseif ($now->lt($startTime)) {
        $status = 'waiting';
    } elseif ($now->between($startTime, $endTime)) {
        $status = 'started';
    } else {
        $status = 'ended';
    }

    // ✅ Format meeting minutes
    $minutes = $meeting->meeting_minute->map(function ($minute) {
        return [
            'id' => $minute->id,
            'meeting_id' => $minute->meeting_id,
            'title' => $minute->title ?? null,
            'description' => $minute->description ?? null,
            'created_at' => $minute->created_at?->format('Y-m-d H:i:s'),
        ];
    });

    return [
        'id' => $meeting->id,
        'topic' => $meeting->topic,
        'start_time' => $startTime,
        'duration' => $meeting->duration,
        'agenda' => $meeting->agenda,
        'join_url' => $meeting->meeting_url,
        'status' => $status,
        'type' => 'database',
        'host' => $meeting->user->name ?? null,
        'document' => $meeting->document,
        'meeting_minutes' => $minutes, // ✅ Added minutes here
    ];
}
    
    // public function (Request $request,$id)

// public function update(Request $request, Meeting $meeting)
public function update(Request $request, $id)
{   
     $meeting=Meeting::find($id);
    // Merge date + time into start_time
    if ($request->filled('meeting_date') && $request->filled('meeting_time')) {
        $request->merge([
            'start_time' => $request->meeting_date . ' ' . $request->meeting_time
        ]);
    }

    // Validate
    $data = $request->validate([
        'topic' => 'required|string',
        'start_time' => 'required|date',
        'duration' => 'required|integer',
        'user_ids' => 'nullable|array',
        'agenda' => 'nullable|string',
        'documents.*' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg,zip|max:5120', // multiple files
    ]);

    // Handle new uploaded files
    $filePaths = json_decode($meeting->document, true) ?? [];
    if ($request->hasFile('documents')) {
        foreach ($request->file('documents') as $file) {
            $filePaths[] = $file->store('meetings', 'public');
        }
    }
    $documentsJson = !empty($filePaths) ? json_encode($filePaths) : null;

    // Calculate start & end time
    $start = new \DateTime($data['start_time']);
    $end = (clone $start)->modify("+{$data['duration']} minutes");

    // Map attendees emails
    $attendees = [];
    if (!empty($data['user_ids'])) {
        $attendees = \App\Models\User::whereIn('id', $data['user_ids'])->pluck('email')->toArray();
    }

    $meetingData = [
        'title' => $data['topic'],
        'start' => $start->format('Y-m-d\TH:i:s'),
        'end' => $end->format('Y-m-d\TH:i:s'),
        'attendees' => $attendees,
        'duration' => $data['duration'],
        'agenda' => $data['agenda'] ?? 'No Agenda',
        'documents' => $documentsJson,
    ];

    // --- Google Meet logic ---
    $rawToken = auth()->user()->google_token;
    $token = json_decode($rawToken, true);
    if (!is_array($token) || !isset($token['access_token'])) {
        session(['meeting_data' => $meetingData, 'meeting_id' => $meeting->id]);
        return response()->json(['redirect' => route('google.redirect')]);
    }

    $client = $this->getClient();
    $client->setAccessToken($token);
    if ($client->isAccessTokenExpired() && isset($token['refresh_token'])) {
        $newToken = $client->fetchAccessTokenWithRefreshToken($token['refresh_token']);
        $newToken['refresh_token'] = $token['refresh_token'];
        auth()->user()->update(['google_token' => json_encode($newToken)]);
        $client->setAccessToken($newToken);
    }

    $service = new \Google\Service\Calendar($client);
    // dd($meeting);

    // Fetch existing Google event
    $event = $service->events->get('primary', $meeting->google_event_id);

    $event->setSummary($meetingData['title']);
    $startDateTime = new \Google\Service\Calendar\EventDateTime();
    $startDateTime->setDateTime($meetingData['start']);
    $startDateTime->setTimeZone(config('app.timezone', 'Asia/Karachi'));
    $event->setStart($startDateTime);
    
    $endDateTime = new \Google\Service\Calendar\EventDateTime();
    $endDateTime->setDateTime($meetingData['end']);
    $endDateTime->setTimeZone(config('app.timezone', 'Asia/Karachi'));
    $event->setEnd($endDateTime);

    if (!empty($meetingData['attendees'])) {
        $event->setAttendees(array_map(fn($email) => ['email' => $email], $meetingData['attendees']));
    }

    $conferenceData = new \Google\Service\Calendar\ConferenceData();
    $createRequest = new \Google\Service\Calendar\CreateConferenceRequest();
    $createRequest->setRequestId(uniqid('meet_', true));
    $conferenceData->setCreateRequest($createRequest);
    $event->setConferenceData($conferenceData);

    $updatedEvent = $service->events->update('primary', $meeting->google_event_id, $event, ['conferenceDataVersion' => 1]);

    $meetLink = null;
    $conf = $updatedEvent->getConferenceData();
    if ($conf && $conf->getEntryPoints()) {
        foreach ($conf->getEntryPoints() as $ep) {
            if ($ep->getEntryPointType() === 'video') {
                $meetLink = $ep->getUri();
                break;
            }
        }
    }

    // Update meeting in DB
    $meeting->update([
        'topic' => $meetingData['title'],
        'start_time' => $meetingData['start'],
        'duration' => $meetingData['duration'],
        'agenda' => $meetingData['agenda'],
        'meeting_url' => $meetLink,
        'document' => $documentsJson,
    ]);

    if (!empty($data['user_ids'])) {
        // Sync participants
        $meeting->participants()->sync($data['user_ids']);

        $participants = \App\Models\User::whereIn('id', $data['user_ids'])->get();
        $participantNamesString = implode(', ', $participants->pluck('name')->toArray());

        foreach ($participants as $user) {
            \Mail::send('emails.meeting_invite', [
                'user_name' => $user->name,
                'topic' => $meeting->topic,
                'agenda' => $meeting->agenda,
                'start_time' => $meeting->start_time,
                'duration' => $meeting->duration,
                'meet_link' => $meeting->meeting_url,
                'meeting_id' => $meeting->id,
                'user_id' => $user->id,
                'all_participants' => $participantNamesString,
            ], function($message) use ($user, $meeting) {
                $message->to($user->email)
                        ->subject('Updated Meeting: ' . $meeting->topic);
            });
        }
    }

    return redirect()->back()->with('success', 'Meeting updated successfully.');
}





//     public function createMeeting(Request $request)
// {
//      dd($request->all());
//     $data = $request->validate([
//         'title' => 'required|string',
//         'start' => 'required|date',
//         'end' => 'required|date|after:start',
//         'attendees' => 'nullable|array',
//     ]);

//     $token = json_decode(auth()->user()->google_token ?? '', true);

//     if (!$token) {
//         session(['meeting_data' => $data]);
//         return response()->json([
//             'redirect' => route('google.redirect')
//         ]);
//     }

//     $client = $this->getClient();
//     $client->setAccessToken($token);

//     if ($client->isAccessTokenExpired() && isset($token['refresh_token'])) {
//         $newToken = $client->fetchAccessTokenWithRefreshToken($token['refresh_token']);
//         $newToken['refresh_token'] = $token['refresh_token'];
//         auth()->user()->update(['google_token' => json_encode($newToken)]);
//         $client->setAccessToken($newToken);
//     }

//     $service = new Calendar($client);

//     $event = new Event([
//         'summary' => $data['title'],
//         'start' => [
//             'dateTime' => (new \DateTime($data['start']))->format(\DateTime::RFC3339),
//             'timeZone' => config('app.timezone', 'Asia/Karachi'),
//         ],
//         'end' => [
//             'dateTime' => (new \DateTime($data['end']))->format(\DateTime::RFC3339),
//             'timeZone' => config('app.timezone', 'Asia/Karachi'),
//         ],
//     ]);

//     if (!empty($data['attendees'])) {
//         $event->setAttendees(array_map(fn($email) => ['email' => $email], $data['attendees']));
//     }

//     $conferenceData = new \Google\Service\Calendar\ConferenceData();
//     $createRequest = new \Google\Service\Calendar\CreateConferenceRequest();
//     $createRequest->setRequestId(uniqid('meet_', true));
//     $conferenceData->setCreateRequest($createRequest);
//     $event->setConferenceData($conferenceData);

//     $createdEvent = $service->events->insert('primary', $event, ['conferenceDataVersion' => 1]);

//     $meetLink = null;
//     $conf = $createdEvent->getConferenceData();
//     if ($conf && $conf->getEntryPoints()) {
//         foreach ($conf->getEntryPoints() as $ep) {
//             if ($ep->getEntryPointType() === 'video') {
//                 $meetLink = $ep->getUri();
//                 break;
//             }
//         }
//     }

//     // ✅ Save meeting in DB
//     $meeting = Meeting::create([
//         'user_id' => auth()->id(),
//         'google_event_id' => $createdEvent->getId(),
//         'topic' => $data['title'],
//         'start_time' => $data['start'],
//         'end_time' => $data['end'],
//         'meeting_url' => $meetLink,
//     ]);

//     // ✅ Attach participants if provided
//     if (!empty($data['attendees'])) {
//         $users = \App\Models\User::whereIn('email', $data['attendees'])->pluck('id')->toArray();
//         $meeting->participants()->attach($users);
//     }

//     return response()->json([
//         'eventId' => $createdEvent->getId(),
//         'meetLink' => $meetLink ?? 'Generating...',
//     ]);
// }

    public function storeDecision($meeting_id, $user_id, $decision)
{
    
    // Validate decision
    if (!in_array($decision, ['yes', 'no', 'maybe'])) {
        abort(400, 'Invalid decision');
    }

    // Find record
    $record = DB::table('meeting_user')
        ->where('meeting_id', $meeting_id)
        ->where('user_id', $user_id)
        ->first();
    // dd($meeting_id,$user_id);
    if (!$record) {
        abort(404, 'Record not found');
    }

    // Update decision
    DB::table('meeting_user')
        ->where('meeting_id', $meeting_id)
        ->where('user_id', $user_id)
        ->update(['decision' => $decision]);

    return view('emails.thankyou', compact('decision'));
}
    public function storeMinutes(Request $request, $meeting){
        // dd($request->all());
        MeetingMinute::create([
            'meeting_id' => $meeting,
            'user_id' => auth()->id(),
            'minute' => $request->minutes,
        ]);
        return redirect()->back()->with('success', 'Meeting minutes saved successfully.');
}


}