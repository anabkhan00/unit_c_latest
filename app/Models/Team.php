<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TeamActivity;

class Team extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users() {
        return $this->belongsToMany(User::class, 'team_user', 'team_id', 'user_id');
    }
    public function activities()
    {
        return $this->hasMany(TeamActivity::class);
    }
}
