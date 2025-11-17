<?php

namespace App\Observers;

use App\Models\Minisite;
use App\Models\TeamActivity;
class MinisiteObserver
{
    /**
     * Handle the Minisite "created" event.
     */
    public function created(Minisite $minisite): void
{
    \Log::info("Naya Minisite record create hua: ".$minisite->team_id);

    try {
        TeamActivity::create([
            'team_id' => $minisite->team_id,
            'activity_name' => ' created a page: ' . $minisite->page_title,
            'description' => $minisite->page_title,
            'user_id' => $minisite->page_added_by,
        ]);
        \Log::info("TeamActivity record successfully created.");
    } catch (\Exception $e) {
        \Log::error("TeamActivity create error: ".$e->getMessage());
    }
}


    /**
     * Handle the Minisite "updated" event.
     */
    public function updated(Minisite $minisite): void
    {
        \Log::info("Minisite record update hua: ".$minisite->id);
        try {
        TeamActivity::create([
            'team_id' => $minisite->team_id,
            'activity_name' => ' updated a page: ' . $minisite->page_title,
            'description' => $minisite->page_title,
            'user_id' => $minisite->page_added_by,
        ]);
        \Log::info("TeamActivity record successfully created.");
    } catch (\Exception $e) {
        \Log::error("TeamActivity create error: ".$e->getMessage());
    }
    }

    public function deleted(Minisite $minisite)
    {
        \Log::info("Minisite record delete hua: ".$minisite->id);
        try {
        TeamActivity::create([
            'team_id' => $minisite->team_id,
            'activity_name' => ' deleted a page: ' . $minisite->page_title,
            'description' => $minisite->page_title,
            'user_id' => $minisite->page_added_by,
        ]);
        \Log::info("TeamActivity record successfully created.");
    } catch (\Exception $e) {
        \Log::error("TeamActivity create error: ".$e->getMessage());
    }
    }


    /**
     * Handle the Minisite "restored" event.
     */
    public function restored(Minisite $minisite): void
    {
        //
    }

    /**
     * Handle the Minisite "force deleted" event.
     */
    public function forceDeleted(Minisite $minisite): void
    {
        //
    }
}
