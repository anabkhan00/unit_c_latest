<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\Email;
use App\Models\Media;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    { 
        $users = User::where('id', '!=', Auth::id())->get();
        $tasks = Task::with(['project', 'sub_task','assignee'])->get();

        $tasks->each(function ($task) {
            $task->expected_days = $task->due_date && $task->project->start_date
                ? Carbon::parse($task->project->start_date)->diffInDays($task->due_date)
                : null;
            $task->days_used = $task->project->start_date
                ? Carbon::parse($task->project->start_date)->diffInDays($task->completed_at ?? now())
                : null;
        });

        $completedTasks = Task::where('status', 'done')->count();
        $inProgressTasks = Task::where('status', 'in_progress')->count();
        $todoTasks = Task::where('status', 'todo')->count();
        $overdueTasks = Task::where('due_date', '<', now())
            ->where('status', '!=', 'done')
            ->count();
        $projects = Project::with('tasks')->get();
        $emails = Email::with('receiver')->where('receiver_id', Auth::id())->get();
        $media = Media::where('user_id', Auth::id())->get();

        // dd($projects);
        return view('pages.project', compact(
            'users',
            'tasks',
            'completedTasks',
            'inProgressTasks',
            'todoTasks',
            'overdueTasks',
            'emails',
            'media',
            'projects'
        ));
    }

    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('pages.project-create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:not_started,in_progress,completed',
            'created_by' => 'required|exists:users,id',
            'tasks.*.title' => 'required|string|max:255',
            'tasks.*.description' => 'nullable|string',
            'tasks.*.assigned_to' => 'nullable|exists:users,id',
            'tasks.*.priority' => 'required|in:low,medium,high',
            'tasks.*.due_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $project = Project::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => $validated['status'],
            'created_by' => $validated['created_by'],
        ]);

        if (!empty($validated['tasks'])) {
            foreach ($validated['tasks'] as $taskData) {
                $project->tasks()->create([
                    'title' => $taskData['title'],
                    'description' => $taskData['description'],
                    'assigned_to' => $taskData['assigned_to'],
                    'status' => 'todo',
                    'priority' => $taskData['priority'],
                    'due_date' => $taskData['due_date'],
                ]);
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Project and tasks created successfully!']);
    }

    public function show(Project $project)
    {
        $project->load(['creator', 'tasks.assignee']);
        return response()->json([
            'id' => $project->id,
            'name' => $project->name,
            'description' => $project->description,
            'start_date' => $project->start_date ? Carbon::parse($project->start_date)->format('d-m-Y') : null,
            'end_date' => $project->end_date ? Carbon::parse($project->end_date)->format('d-m-Y') : null,
            'status' => ucfirst($project->status),
            'created_by' => $project->creator ? ['id' => $project->creator->id, 'name' => $project->creator->name] : null,
            'tasks' => $project->tasks->map(function ($task) {
                return [
                    'id' => $task->id,
                    'title' => $task->title,
                    'description' => $task->description,
                    'status' => ucfirst(str_replace('_', ' ', $task->status)),
                    'priority' => ucfirst($task->priority),
                    'due_date' => $task->due_date ? Carbon::parse($task->due_date)->format('d-m-Y') : null,
                    'completed_at' => $task->completed_at ? Carbon::parse($task->completed_at)->format('d-m-Y') : null,
                    'assignee' => $task->assignee ? ['id' => $task->assignee->id, 'name' => $task->assignee->name] : null,
                    'expected_days' => $task->due_date && $task->project->start_date
                        ? Carbon::parse($task->project->start_date)->diffInDays($task->due_date)
                        : null,
                    'days_used' => $task->project->start_date
                        ? Carbon::parse($task->project->start_date)->diffInDays($task->completed_at ?? now())
                        : null,
                ];
            }),
        ]);
    }

    public function edit(Project $project)
    {
        $users = User::where('id', '!=', Auth::id())->get();
        $project->load('tasks');
        return view('pages.project-edit', compact('project', 'users'));
    }
    
    public function update_main(Request $request, $id)
{
    // ✅ 1. Validate incoming request
    $request->validate([
        'name' => 'required|string|max:255',
        'created_by' => 'required|integer|exists:users,id',
        'description' => 'nullable|string',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'status' => 'required|in:not_started,in_progress,completed',
        'tasks' => 'nullable|array',
        'tasks.*.title' => 'required|string|max:255',
        'tasks.*.description' => 'nullable|string',
        'tasks.*.assigned_to' => 'nullable|integer|exists:users,id',
        'tasks.*.priority' => 'nullable|in:low,medium,high',
        'tasks.*.due_date' => 'nullable|date',
    ]);

    // ✅ 2. Find the project
    $project = Project::with('tasks')->findOrFail($id);

    // ✅ 3. Update project main info
    $project->update([
        'name' => $request->name,
        'created_by' => $request->created_by,
        'description' => $request->description,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'status' => $request->status,
    ]);

    // ✅ 4. Handle tasks
    $existingTaskIds = $project->tasks->pluck('id')->toArray();
    $incomingTasks = $request->tasks ?? [];

    $newTaskIds = [];

    foreach ($incomingTasks as $taskData) {
        if (isset($taskData['id']) && in_array($taskData['id'], $existingTaskIds)) {
            // 🟢 Update existing task
            $task = Task::find($taskData['id']);
            $task->update([
                'title' => $taskData['title'],
                'description' => $taskData['description'] ?? null,
                'assigned_to' => $taskData['assigned_to'] ?? null,
                'priority' => $taskData['priority'] ?? 'medium',
                'due_date' => $taskData['due_date'] ?? null,
            ]);
            $newTaskIds[] = $task->id;
        } else {
            // 🆕 Create new task
            $task = $project->tasks()->create([
                'title' => $taskData['title'],
                'description' => $taskData['description'] ?? null,
                'assigned_to' => $taskData['assigned_to'] ?? null,
                'priority' => $taskData['priority'] ?? 'medium',
                'due_date' => $taskData['due_date'] ?? null,
            ]);
            $newTaskIds[] = $task->id;
        }
    }

    // 🔴 Delete tasks that were removed in the form
    $tasksToDelete = array_diff($existingTaskIds, $newTaskIds);
    if (!empty($tasksToDelete)) {
        Task::whereIn('id', $tasksToDelete)->delete();
    }

    return redirect()->back()->with('success', 'Project updated successfully!');
}

    public function update(Request $request, Project $project)
    {   
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:not_started,in_progress,completed',
            'created_by' => 'required|exists:users,id',
        ]);

        $statusChanged = $project->status !== $validated['status'];

        $project->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => $validated['status'],
            'created_by' => $validated['created_by'],
        ]);

        if ($statusChanged) {
            \App\Models\ProjectStatus::create([
                'project_id' => $project->id,
                'status' => $validated['status'],
                'updated_by' => Auth::id(),
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Project updated successfully.',
            'project' => [
                'id' => $project->id,
                'name' => $project->name,
                'description' => $project->description,
                'start_date' => $project->start_date,
                'end_date' => $project->end_date,
                'status' => $project->status,
                'created_by' => $project->created_by,
            ],
        ]);
    }

    public function destroy(Project $project)
    {
        $project->tasks()->delete();
        $project->delete();
        return response()->json(['status' => 'success', 'message' => 'Project deleted successfully']);
    }

    public function graph()
    {
        return response()->json([
            'completedTasks' => Task::where('status', 'done')->count(),
            'inProgressTasks' => Task::where('status', 'in_progress')->count(),
            'todoTasks' => Task::where('status', 'todo')->count(),
            'overdueTasks' => Task::where('due_date', '<', now())->where('status', '!=', 'done')->count(),
        ]);
    }

    public function getUsers()
    {
        $users = User::all(['id', 'name']);
        return response()->json($users);
    }
}
