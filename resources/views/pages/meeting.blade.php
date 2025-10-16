@extends('layouts.master')

@section('content')
  <style>
    .nav-btn {
      background-color: transparent;
      border: none;
      padding: 0px;
      margin-right: 6px;
      border-radius: 0px;
      font-weight: 600;
      transition: 0.2s;
      font-size:12px;
    }
    .nav-btn:hover {
      color: #d6d8db !important;
    }
    .nav-btn.active {
      
      color: #0C5097 !important;
    }
    .tab-btn {
      background-color: #DDDDDD;
      border: none;
      padding: 8px 18px;
      margin-right: 5px;
      border-radius: 6px;
      font-weight: 600;
    }
    .tab-btn.active {
      background-color: #0C5097;
      color: white;
    }
    .bluemeting{
            font-size: 1.25rem;
            font-weight: 700;
            color: #0C5097;
    }
    .smalll{
        font-size: 10px;
        color: black;
        font-weight: 700;
    }
    .fouirteen {
        font-size: 14px;
        font-weight: 700;
    }
       .fouirteenn {
        font-size: 14px;
        font-weight: 500;
    }
    .twenty{
        font-size: 20px !important;
        font-weight: 700;
        color: black;
    }
    .twelve {
        font-size: 12px;
        color: black;
        font-weight: 500;
    }
        .twelvebold {
        font-size: 12px;
        color: black;
        font-weight: 700;
    }
    .btnblue {
        background-color: #077cbb;
        color: white;
        border-radius: 6px;
        padding: 5px 20px;
        font-weight: 400;
        border: none;
    }
    .borderr {
        border-bottom: 1px solid #DDDDDD;
        padding-bottom: 10px;
    }
    .btnblack{
           background-color: white;
        color: black;
        border-radius: 6px;
        padding: 5px 20px;
        font-weight: 400;
        border: 1px solid black;
    }
    .mutedd{
        color: #DEDEDE;
    }
    .redd{
         color: #de2020 !important;
    }
    .bluee{
            color: #42a5f6 !important;
    }
  </style>
    @include('pages.main', ['emails' => $emails])
    <div class="container" id="meeting-content" style="display: block; position: absolute;top: 180px; left: 120px;">
        <div style="display: flex; justify-content: space-between;align-items: center;">
            <div style="display: flex; align-items: end; gap: 10px;">
                <div class="d-flex">
                    <p style="color: #0C5097;font-size: 20px;font-weight: 700;" class="me-2">Meeting</p>
                     <button class="nav-btn active" data-bs-target="#home">Meetings</button>
  <button class="nav-btn" data-bs-target="#profile">Resolutions</button>
  <button class="nav-btn" data-bs-target="#messages">Noticeboard</button>
                </div>
            </div>
            <div>
                <!-- Button to trigger modal -->
                <button type="button" data-bs-toggle="modal" data-bs-target="#scheduleMeetingModal"
                    style="border: none; width: 150px; height: 35px; padding: 5px 10px; gap: 20px; border-radius: 5px; background: #0C5097; color: white;">
                    Schedule Meeting
                </button>

                <!-- Modal -->
                <div class="modal fade" id="scheduleMeetingModal" tabindex="-1" aria-labelledby="scheduleMeetingModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('meetings.store') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="scheduleMeetingModalLabel">Schedule Google Meet</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="users" class="form-label">Invite Users (by email)</label>
                                        <select name="user_ids[]" multiple class="form-control" required>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}
                                                    ({{ $user->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">Selected users will receive calendar invites</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="topic" class="form-label">Meeting Topic</label>
                                        <input type="text" class="form-control" name="topic" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="start_time" class="form-label">Start Time</label>
                                        <input type="datetime-local" class="form-control" name="start_time" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="duration" class="form-label">Duration (minutes)</label>
                                        <input type="number" class="form-control" name="duration" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="agenda" class="form-label">Agenda</label>
                                        <textarea class="form-control" name="agenda" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  style="border: 1px solid #0C5097; width: 150px; height: 35px; padding: 5px 10px; gap: 20px; border-radius: 5px; background: white; color: #0C5097;">Cancel</button>
                                    <button type="submit" class="btn btn-primary"  style="border: none; width: 150px; height: 35px; padding: 5px 10px; gap: 20px; border-radius: 5px; background: #0C5097; color: white;">Create Google Meet</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <div id="tabContent">
  <div id="home" class="tab-pane-content" style="border:none">   <div class="table-container" >
            <table>
                <thead>
                    <tr style="font-size: 13px;">
                        <th style="padding: 0px;">Title</th>
                        <th style="padding: 0px;"></th>
                        <th style="padding: 0px;">Host</th>
                        <th style="padding: 0px;">Date/Time</th>
                        <th style="padding: 0px;">Type</th>
                        <th style="padding: 0px;"></th>
                        <th style="padding: 0px;"></th>
                        <th style="padding: 0px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($meetings as $meeting)
                        @php
                            $status = match ($meeting['status']) {
                                'waiting' => 'Upcoming',
                                'started' => 'Ongoing',
                                'ended' => 'Finished',
                                'cancelled' => 'Cancelled',
                                default => 'Unknown',
                            };

                            $btnColor = $status === 'Ongoing' ? '#000000' : '#0C5097';
                            $opacity = $status === 'Cancelled' || $status === 'Finished' ? '0.3' : '1';
                            $disabledRow = $status === 'Cancelled' ? 'pointer-events: none; background-color: #f2f2f2;' : '';
                            $joinUrl = $meeting['join_url'] ?? '#';

                            // For Google Meet events, we don't have participant info from API
                            $assignedUsers = isset($meeting['type']) && $meeting['type'] === 'database' ?
                                \App\Models\Meeting::find($meeting['id'])->participants :
                                collect([]);
                        @endphp

                        <tr style="opacity: {{ $opacity }}; {{ $disabledRow }}">
                            <td style="padding: 3px;font-size: 14px; color:#000000;font-weight:500;">
                                {{ \Illuminate\Support\Str::limit($meeting['topic'], 40) }}
                            </td>
                            @php
                                $meetingStartTime = \Carbon\Carbon::parse($meeting['start_time'])->timezone(config('app.timezone', 'Asia/Karachi'));
                                $meetingEndTime = $meetingStartTime->copy()->addMinutes($meeting['duration'] ?? 60);
                                $currentTime = \Carbon\Carbon::now(config('app.timezone', 'Asia/Karachi'));
                                $isButtonEnabled = $currentTime->between($meetingStartTime->subMinutes(30), $meetingEndTime);
                            @endphp

                            <td>
                                @if ($status !== 'Cancelled' && $status !== 'Finished' && $joinUrl !== '#')
                                    <a href="{{ $joinUrl }}" target="_blank" rel="noopener noreferrer"
                                        @if (!$isButtonEnabled) style="pointer-events: none; opacity: 0.5;" @endif>
                                        <i class="fas fa-video" style="font-size: 20px; color: green;"></i>
                                    </a>
                                @endif
                            </td>

                            <td style="padding: 3px;font-size: 14px; color:#000000;font-weight:500;">{{ $meeting['host'] ?? 'Unknown' }}</td>
                            <td style="padding: 3px;font-size: 14px; color:#000000;font-weight:500;">
                                {{ $meetingStartTime->format('d-M-y h:i A') }}
                            </td>
                            <td style="padding: 3px;font-size: 14px; color:#000000;font-weight:500;">{{ $status }}</td>
                            <td style="padding: 3px;">
                                <button
                                    style="border: none; height: 35px; font-size: 14px; padding: 5px 10px; border-radius: 5px; background: black; color: white;"
                                    data-bs-toggle="modal" data-bs-target="#viewMeetingDetailModal{{ $meeting['id'] }}">
                                    View Detail
                                </button>
                            </td>

                      <div class="modal fade" id="viewMeetingDetailModal{{ $meeting['id'] }}" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-3 shadow">

      <!-- Modal Body -->
      <div class="modal-body">
        <div class="d-flex justify-content-between">
          <div>
            <h5 class="bluemeting">Meeting</h5>
            <p class="smalll">{{ $meetingStartTime->format('d-M-y h:i A') }}</p>
          </div>
          <div>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
        </div>

        <!-- Custom Tab Buttons -->
        <div class="d-flex mb-3">
          <button class="tab-btn active" data-bs-target="#agenda{{ $meeting['id'] }}">Agenda</button>
          <button class="tab-btn" data-bs-target="#attendees{{ $meeting['id'] }}">Attendees</button>
          <button class="tab-btn" data-bs-target="#document{{ $meeting['id'] }}">Document</button>
          <button class="tab-btn" data-bs-target="#minutes{{ $meeting['id'] }}">Minutes</button>
        </div>

        <!-- Tab Content -->
        <div id="tabContent">

          <!-- Agenda Tab -->
          <div id="agenda{{ $meeting['id'] }}" class="tab-pane-content d-flex flex-column" style="height:350px;">
            <div>
              <p class="twenty ">{{ $meeting['topic'] }}</p>
              <p class="fouirteen ">invited you in the "{{   $joinUrl}}"</p>
              <p class=" fouirteenn">{{ $meeting['agenda'] ?? 'No agenda provided.' }}</p>
              <p class="twelve">Duration: {{ $meeting['duration'] }} minutes</p>
            </div>
            <div class="divs mt-auto d-flex justify-content-end gap-2">
              <button class="btnblue">Yes</button>
              <button class="btnblack">Maybe</button>
  <button class="btnblack" data-bs-dismiss="modal">No</button>

            </div>
          </div>

          <!-- Attendees Tab -->
          <div id="attendees{{ $meeting['id'] }}" class="tab-pane-content d-none d-flex flex-column" style="height:350px;">
            @if($assignedUsers->count() > 0)
              <div>
                @foreach($assignedUsers as $user)
                  <div class="row d-flex align-items-center mb-3 borderr">
                    <div class="col-md-10 d-flex align-items-center">
                      <div>
                        <img src="/images/profile.svg" alt="Profile" width="50" class="me-2">
                      </div>
                      <div>
                        <p class="twelvebold m-0">{{ $user->name }}</p>
                        <p class="twelve">{{ $user->email }}</p>
                      </div>
                    </div>
                    <div class="col-md-2 text-end">
                      <button class="btnblue">Yes</button>
                    </div>
                  </div>
                @endforeach
              </div>
              <div class="divs mt-auto">
                <span class="twelvebold">Total: {{ $assignedUsers->count() }}</span>
              </div>
            @else
              <p>No attendees found.</p>
            @endif
          </div>

          <!-- Document Tab -->
          <div id="document{{ $meeting['id'] }}" class="tab-pane-content d-none d-flex justify-content-center align-items-center" style="height:350px;">
            <div>
              <p class="text-center m-0"><i class="bi bi-folder-fill"></i></p>
              <p class="m-0 twelve">No Attachment</p>
            </div>
          </div>

          <!-- Minutes Tab -->
          <div id="minutes{{ $meeting['id'] }}" class="tab-pane-content d-none" style="height:350px;">
            <p class="twelve">1 - Meeting Minute has been created</p>
            <p class="twelve">2 - Meeting Minute has been created 2</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>


                            <!-- Edit Button (only for database meetings) -->
                            <td>
                                @if ($status !== 'Cancelled' && $status !== 'Finished' && isset($meeting['type']) && $meeting['type'] === 'database')
                                    <button type="button"  class="btn  p-0" style="padding: 3px;font-size: 14px; color:#0C5097;font-weight:500;text-decoration: none;"
                                            data-bs-toggle="modal" data-bs-target="#editMeetingModal{{ $meeting['id'] }}">
                                        Edit
                                    </button>
                                @endif
                            </td>

                            <!-- Delete Button (only for database meetings) -->
                            <td>
                                @if (isset($meeting['type']) && $meeting['type'] === 'database')
                                    <form action="{{ route('meetings.destroy', $meeting['id']) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0" style="padding: 3px;font-size: 14px; color:#0C5097;font-weight:500;text-decoration: none;"
                                                onclick="return confirm('Are you sure you want to delete this meeting?')">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </td>

                            <!-- Edit Modal (only for database meetings) -->
                            @if (isset($meeting['type']) && $meeting['type'] === 'database')
                                <div class="modal fade" id="editMeetingModal{{ $meeting['id'] }}" tabindex="-1"
                                    aria-labelledby="editMeetingModalLabel{{ $meeting['id'] }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form method="POST" action="{{ route('meetings.update', $meeting['id']) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editMeetingModalLabel{{ $meeting['id'] }}">
                                                        Edit Meeting</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    @php
                                                        $dbMeeting = \App\Models\Meeting::find($meeting['id']);
                                                        $assignedUserIds = $dbMeeting->participants->pluck('id')->toArray();
                                                    @endphp

                                                    <div class="mb-3">
                                                        <label for="user_ids{{ $meeting['id'] }}" class="form-label" style="font-weight:500">Invite Users</label>
                                                        <select name="user_ids[]" id="user_ids{{ $meeting['id'] }}"
                                                            class="form-control" multiple required>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id }}"
                                                                    {{ in_array($user->id, $assignedUserIds) ? 'selected' : '' }}>
                                                                    {{ $user->name }} ({{ $user->email }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="topic{{ $meeting['id'] }}"
                                                            class="form-label" style="font-weight:500">Topic</label>
                                                        <input type="text" class="form-control" name="topic"
                                                            id="topic{{ $meeting['id'] }}" value="{{ $meeting['topic'] }}"
                                                            required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="start_time{{ $meeting['id'] }}" class="form-label" style="font-weight:500">Start
                                                            Time</label>
                                                        <input type="datetime-local" class="form-control" name="start_time"
                                                            id="start_time{{ $meeting['id'] }}"
                                                            value="{{ \Carbon\Carbon::parse($meeting['start_time'])->timezone('Asia/Karachi')->format('Y-m-d\TH:i') }}"
                                                            required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="duration{{ $meeting['id'] }}" class="form-label" style="font-weight:500">Duration
                                                            (minutes)
                                                        </label>
                                                        <input type="number" class="form-control" name="duration"
                                                            id="duration{{ $meeting['id'] }}"
                                                            value="{{ $meeting['duration'] }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="agenda{{ $meeting['id'] }}"
                                                            class="form-label" style="font-weight:500">Agenda</label>
                                                        <textarea class="form-control" name="agenda" id="agenda{{ $meeting['id'] }}" rows="3">{{ $meeting['agenda'] ?? '' }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" style="border: none; width: 150px; height: 35px; padding: 5px 10px; gap: 20px; border-radius: 5px; background: #0C5097; color: white;">Update Meeting</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal" style="border: 1px solid #0C5097; width: 150px; height: 35px; padding: 5px 10px; gap: 20px; border-radius: 5px; background:white ; color: #0C5097;">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div></div>
  <div id="profile" class="tab-pane-content d-none">This is the Profile tab content.</div>
  <div id="messages" class="tab-pane-content d-none">Here are your Messages.</div>
  <div id="settings" class="tab-pane-content d-none">Settings go here.</div>
</div>
     
    </div>
    <script>
  // Custom nav button switcher
  document.querySelectorAll(".nav-btn").forEach(btn => {
    btn.addEventListener("click", function() {
      // Remove active from all buttons
      document.querySelectorAll(".nav-btn").forEach(b => b.classList.remove("active"));
      // Hide all tab contents
      document.querySelectorAll(".tab-pane-content").forEach(c => c.classList.add("d-none"));

      // Activate clicked button
      this.classList.add("active");
      // Show relevant content
      document.querySelector(this.getAttribute("data-bs-target")).classList.remove("d-none");
    });
  });
  document.querySelectorAll('.tab-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    const parent = this.closest('.modal-body');
    parent.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    parent.querySelectorAll('.tab-pane-content').forEach(tab => tab.classList.add('d-none'));

    this.classList.add('active');
    parent.querySelector(this.dataset.bsTarget).classList.remove('d-none');
  });
});

</script>

@endsection
