<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubTask;

class SubTaskController extends Controller
{
    public function store(Request $request)
    {
        // ✅ Validation rules
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:not_started,in_progress,completed',
        ]);

        // ✅ Store sub-task
        $subTask = SubTask::create([
            'task_id' => $request->task_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        // ✅ Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'Sub Task added successfully!',
            'data' => $subTask
        ]);
    }
}
