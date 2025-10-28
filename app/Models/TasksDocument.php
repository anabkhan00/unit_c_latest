<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TasksDocument extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'document_path','uploaded_by' ];

}
