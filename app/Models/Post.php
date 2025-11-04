<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'linkedin_post_id',
    ];

    // Relation with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
