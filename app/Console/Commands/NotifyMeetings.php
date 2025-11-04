<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Meeting;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
class NotifyMeetings extends Command
{   
    protected $signature = 'meetings:notify';
    protected $description = 'Notify about meetings starting now';

    public function handle()
    {
        // $now = Carbon::now()->format('Y-m-d H:i');

        $now = Carbon::now();
$meetings = Meeting::where('start_time', '>=', $now->copy()->second(0))
                   ->where('start_time', '<', $now->copy()->addMinute()->second(0))
                   ->where('notified', false)
                   ->get();

if ($meetings->isEmpty()) {
    // Log::info("No meetings starting at {$now->format('Y-m-d H:i')}");
} else {
    foreach ($meetings as $meeting) {
        // Log::info("Meeting starting now: {$meeting->topic}");
        $meeting->notified = true;
        $meeting->save();
    }
}


        $this->info('Meeting notifications checked.');
    }
}






    

    

