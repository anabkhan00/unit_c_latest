<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamActivity extends Model
{
    use HasFactory;

    protected $table = 'team_activity';

    protected $fillable = [
    'team_id',
    'activity_name',
    'description',
    'user_id',
];

    // Relation with Team model
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
