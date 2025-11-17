<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Meeting Invitation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px;">
    <div style="background-color: #fff; padding: 20px; border-radius: 8px;">
        <!-- Participant Greeting -->
        <h2 style="color: #333;">Hello {{ $user_name }} 👋</h2>
        <p>You're invited to a meeting! Please see the details below:</p>

        <!-- Meeting Details -->
        <p><strong>Topic:</strong> {{ $topic }}</p>
        <p><strong>Agenda:</strong> {{ $agenda }}</p>
        <p><strong>Start Time:</strong> {{ \Carbon\Carbon::parse($start_time)->format('d M Y, h:i A') }}</p>
        <p><strong>Duration:</strong> {{ $duration }} minutes</p>
        @if(!empty($meet_link))
            <p><strong>Meeting Link:</strong> <a href="{{ $meet_link }}" target="_blank">{{ $meet_link }}</a></p>
        @endif

        <!-- All Participants -->
        <p><strong>All Participants:</strong> {{ $all_participants }}</p>

        <hr>

        <!-- Decision Buttons -->
        <p>Please select your decision:</p>

        <a href="{{ route('meeting.decision', [$meeting_id, $user_id, 'yes']) }}" 
           style="background: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; margin-right:5px;">
           ✅ Yes
        </a>

        <a href="{{ route('meeting.decision', [$meeting_id, $user_id, 'no']) }}" 
           style="background: #dc3545; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; margin-right:5px;">
           ❌ No
        </a>

        <a href="{{ route('meeting.decision', [$meeting_id, $user_id, 'maybe']) }}" 
           style="background: #ffc107; color: black; padding: 10px 15px; text-decoration: none; border-radius: 5px;">
           🤔 Maybe
        </a>
    </div>
</body>
</html>
