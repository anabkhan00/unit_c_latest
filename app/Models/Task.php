<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SubTask;

class Task extends Model
{
    protected $fillable = ['project_id', 'title', 'description', 'assigned_to', 'status', 'priority', 'due_date', 'completed_at'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function sub_task()
    {
        return $this->hasMany(SubTask::class,'task_id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function statusHistory()
    {
        return $this->hasMany(TaskStatus::class, 'task_id');
    }
}
