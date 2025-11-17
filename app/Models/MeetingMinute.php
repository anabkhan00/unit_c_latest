<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingMinute extends Model
{
    use HasFactory;

        protected $fillable = [
        'meeting_id',
        'user_id',
        'minute',
    ];

    /**
     * Relationships
     */

    // A minute belongs to one meeting
    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    // A minute belongs to one user (who added it)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
