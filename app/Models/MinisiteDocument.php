<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinisiteDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'document',
        'document_title',
        'document_added_by',
        'team_id',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'document_added_by');
    }
    
}
