<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Models\User;
use Kreait\Firebase\Factory;

class ChatController extends Controller
{
    
    public function index_list()
    {   $receiver_id=auth()->user()->id;
        $users=User::get();
        // dd($users);
        return view('chat.index', compact('receiver_id','users'));
    }
    public function index($receiver_id)
    {
        return view('chat.index', compact('receiver_id'));
    }

public function send(Request $request)
{
    $request->validate([
        'sender_id' => 'required',
        'receiver_id' => 'required',
        'message' => 'nullable|string',
        'file' => 'nullable|file|max:10240', // 10MB max
    ]);

    $firebase = (new \Kreait\Firebase\Factory)
        ->withServiceAccount(config('firebase.credentials.file'))
        ->withDatabaseUri(config('firebase.database.url'));

    $database = $firebase->createDatabase();

    $data = [
        'sender_id' => $request->sender_id,
        'receiver_id' => $request->receiver_id,
        'type' => 'text',
        'read' => false,
        'delivered' => false,
        'timestamp' => now()->timestamp,
    ];

    // 🟢 If file uploaded, save in Laravel storage
    if ($request->hasFile('file')) {
        $path = $request->file('file')->store('chat_files', 'public');
        $url = asset('storage/' . $path);

        $data['type'] = 'file';
        $data['message'] = $url;
        $data['filename'] = $request->file('file')->getClientOriginalName();
        $data['filetype'] = $request->file('file')->getClientMimeType();
    } else {
        $data['message'] = $request->message;
    }

    // 🟢 Push to Firebase Realtime DB (only link)
    $ref = $database->getReference('messages')->push($data);
    $firebase_key = $ref->getKey();

    // 🟢 Optionally store locally (for backup)
    \App\Models\ChatMessage::create([
        'sender_id' => $request->sender_id,
        'receiver_id' => $request->receiver_id,
        'message' => $data['message'],
        'type' => $data['type'],
        'firebase_doc_id' => $firebase_key,
    ]);

    return response()->json(['success' => true, 'url' => $data['message']]);
}


    public function teamList()
    {
        $user = auth()->user();
        // Only teams where user is a member
        $teams = $user->teams()->get();
        return view('chat.team_chat', compact('teams', 'user'));
    }

    // 🧩 View specific team chat
    public function teamChat($team_id)
    {
        $team = Team::findOrFail($team_id);
        $members = $team->users;
        return view('chat.team_chat', compact('team', 'members'));
    }

    // 📨 Send group message
    public function sendGroupMessage(Request $request)
    {
        $request->validate([
            'sender_id' => 'required',
            'team_id' => 'required',
            'message' => 'required|string',
        ]);

        $firebase = (new Factory)
            ->withServiceAccount(config('firebase.credentials.file'))
            ->withDatabaseUri(config('firebase.database.url'))
            ->createDatabase();

        $data = [
            'sender_id' => $request->sender_id,
            'team_id' => $request->team_id,
            'message' => $request->message,
            'type' => 'text',
            'timestamp' => now()->timestamp,
            'read_by' => [$request->sender_id => true], // 👈 Track which users read it
        ];

        $ref = $firebase->getReference('group_messages/' . $request->team_id)->push($data);

        return response()->json(['success' => true]);
    }
    public function sendGroupFile(Request $request)
{
    $request->validate([
        'file' => 'required|file|max:10240', // 10MB max
        'sender_id' => 'required',
        'team_id' => 'required',
    ]);

    $file = $request->file('file');
    $path = $file->store('chat_files', 'public');

    $firebase = (new \Kreait\Firebase\Factory)
        ->withServiceAccount(config('firebase.credentials.file'))
        ->withDatabaseUri(config('firebase.database.url'))
        ->createDatabase();

    $data = [
        'sender_id' => $request->sender_id,
        'team_id' => $request->team_id,
        'message' => asset('storage/' . $path),
        'type' => 'file',
        'filename' => $file->getClientOriginalName(),
        'timestamp' => now()->timestamp,
        'read_by' => [$request->sender_id => true],
    ];

    $firebase->getReference('group_messages/' . $request->team_id)->push($data);

    return response()->json(['success' => true]);
}

}













