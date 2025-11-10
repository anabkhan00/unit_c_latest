<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Email;
use App\Models\Media;
use App\Models\Meeting;
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
            $dbMeetings = Meeting::with(['user', 'participants'])
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

        // ✅ Hardcoded credentials (for now) set
        
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect_uri'));

        // ✅ Required settings
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        $client->setScopes([Calendar::CALENDAR_EVENTS]);

        return $client;
    }

    /**
     * Step 1: Redirect user to Google OAuth
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
    // Map the incoming request to the expected data structure
    $data = $request->validate([
        'topic' => 'required|string',
        'start_time' => 'required|date',
        'duration' => 'required|integer',
        'user_ids' => 'nullable|array',
        'agenda' => 'required|string',
    ]);

    // Calculate end time from start_time + duration (minutes)
    $start = new \DateTime($data['start_time']);
    $end = (clone $start)->modify("+{$data['duration']} minutes");

    // Map attendees emails from user_ids
    $attendees = [];
    if (!empty($data['user_ids'])) {
        $attendees = \App\Models\User::whereIn('id', $data['user_ids'])->pluck('email')->toArray();
    }

    $meetingData = [
        'title' => $data['topic'],
        'start' => $start->format('Y-m-d\TH:i:s'),
        'end' => $end->format('Y-m-d\TH:i:s'),
        'attendees' => $attendees,
        "duration" => $data['duration'],
        "agenda" => $data['agenda'] ?? 'No Agenda',
    ];



    $token = json_decode(auth()->user()->google_token ?? '', true);

    if (!$token) {
        session(['meeting_data' => $meetingData]);
        return response()->json([
            'redirect' => route('google.redirect')
        ]);
    }

    $client = $this->getClient();
    $client->setAccessToken($token);

    if ($client->isAccessTokenExpired() && isset($token['refresh_token'])) {
        $newToken = $client->fetchAccessTokenWithRefreshToken($token['refresh_token']);
        $newToken['refresh_token'] = $token['refresh_token'];
        auth()->user()->update(['google_token' => json_encode($newToken)]);
        $client->setAccessToken($newToken);
    }

    $service = new Calendar($client);

    $event = new Event([
        'summary' => $meetingData['title'],
        'start' => [
            'dateTime' => $meetingData['start'],
            'timeZone' => config('app.timezone', 'Asia/Karachi'),
        ],
        'end' => [
            'dateTime' => $meetingData['end'],
            'timeZone' => config('app.timezone', 'Asia/Karachi'),
        ],
    ]);

    if (!empty($meetingData['attendees'])) {
        $event->setAttendees(array_map(fn($email) => ['email' => $email], $meetingData['attendees']));
    }

    $conferenceData = new \Google\Service\Calendar\ConferenceData();
    $createRequest = new \Google\Service\Calendar\CreateConferenceRequest();
    $createRequest->setRequestId(uniqid('meet_', true));
    $conferenceData->setCreateRequest($createRequest);
    $event->setConferenceData($conferenceData);

    $createdEvent = $service->events->insert('primary', $event, ['conferenceDataVersion' => 1]);

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

        "agenda" => $meetingData['agenda'],
        'meeting_url' => $meetLink,
    ]);

    // Attach participants
    if (!empty($data['user_ids'])) {
        $meeting->participants()->attach($data['user_ids']);
    }

    return response()->json([
        'eventId' => $createdEvent->getId(),
        'meetLink' => $meetLink ?? 'Generating...',
    ]);
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

        return [
            'id' => $meeting->id,
            'topic' => $meeting->topic,
            'start_time' => $startTime,
            'duration' => $meeting->duration,
            'agenda' => $meeting->agenda,
            'join_url' => $meeting->meeting_url,
            'status' => $status,
            'type' => 'database',
            'host' => $meeting->user->name
        ];
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

}
