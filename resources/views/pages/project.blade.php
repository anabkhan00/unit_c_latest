@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/project.css') }}">
    @include('pages.main', ['emails' => $emails])

    <div class="container-fluid" id="project-content" style="position: absolute; top: 185px; left: 60px; width: 95%;">
        <div class="row">
            <div class="row">
                
                <div class="col-12 rounded p-3" style="background-color: #F4F4F4;">
                    <div style="display: flex; margin-bottom: 15px; justify-content: space-between;">
                            <div>
                                <p style="color: #0C5097; font-weight: bold; font-size: 18px;">Projects Overview</p>
                            </div>
                            <div>
                                <button type="button" class="btn" style="background: #0C5097; color: white"
                                    data-bs-toggle="modal" data-bs-target="#projectModal">+</button>
                            </div>
                        </div>
                    @foreach($projects as $project)
    <button type="button"
        class="btn btn-project"
        style="background:#0C5097; color:white"
        data-project='@json($project)'>
        {{ $project->name }}
    </button>
@endforeach

                </div>
            </div>
            <div class="d-flex flex-row w-100 gap-3" style="margin-bottom: 0;">
                <div class="flex-grow-1 p-3" style="min-width: 350px; max-width: 500px; ">
                    <div class="rounded p-3" style="background-color: #F4F4F4; height: 252px !important;">
                        <div style="display: flex; margin-bottom: 15px; justify-content: space-between;">
                            <div>
                                <p style="color: #0C5097; font-weight: bold; font-size: 18px;">Tasks Overview</p>
                            </div>
                            {{--  <div>
                                <button type="button" class="btn" style="background: #0C5097; color: white"
                                    data-bs-toggle="modal" data-bs-target="#projectModal">+</button>
                            </div>  --}}
                                         
<button type="button"
    id="editMainButton"
    class="btn btn-edit-project"
    style="background:#0C5097; color:white"
    data-bs-toggle="modal"
    data-bs-target="#editMainProjectModal"
    data-project="">
    Edit Selected Project
</button>

                        </div>
                        <div class="row my-3">
                            <div class="col-6">
                                <div style="border: 0.73px solid #0B9F2A; border-radius: 5px;">
                                    <div class="row" style="padding: 5px;">
                                        <div class="col-8">
                                            <p style="font-size: 12px; margin-bottom: 0px; color: #10AA2E;">Completed Tasks
                                            </p>
                                            <p id="completedTasksCount"
                                                style="font-size: 20px; font-weight: bold; color: #10AA2E; margin-bottom: 0px;">
                                                {{ $completedTasks }}
                                            </p>
                                        </div>
                                        <div class="col-4"
                                            style="display: flex; align-items: center; justify-content: center;">
                                            <svg width="40" viewBox="0 0 51 51" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <rect x="0.136719" y="0.355225" width="50.1475" height="50.1475"
                                                    fill="url(#pattern0_246_331)" />
                                                <defs>
                                                    <pattern id="pattern0_246_331" patternContentUnits="objectBoundingBox"
                                                        width="1" height="1">
                                                        <use xlink:href="#image0_246_331" transform="scale(0.0175439)" />
                                                    </pattern>
                                                    <image id="image0_246_331" width="57" height="57"
                                                        xlink:href="data:image/png;base64,...(same as original)..." />
                                                </defs>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div style="border: 0.73px solid #FF6C1C; border-radius: 5px;">
                                    <div class="row" style="padding: 5px;">
                                        <div class="col-8">
                                            <p style="font-size: 12px; margin-bottom: 0px; color: #FF6C1C;">Tasks In
                                                Progress</p>
                                            <p id="inProgressTasksCount"
                                                style="font-size: 20px; font-weight: bold; color: #FF6C1C; margin-bottom: 0px;">
                                                {{ $inProgressTasks }}
                                            </p>
                                        </div>
                                        <div class="col-4"
                                            style="display: flex; align-items: center; justify-content: center;">
                                            <svg width="40" viewBox="0 0 52 53" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <rect x="0.404297" y="0.628418" width="51.6011" height="51.6011"
                                                    fill="url(#pattern0_246_334)" />
                                                <defs>
                                                    <pattern id="pattern0_246_334" patternContentUnits="objectBoundingBox"
                                                        width="1" height="1">
                                                        <use xlink:href="#image0_246_334" transform="scale(0.0175439)" />
                                                    </pattern>
                                                    <image id="image0_246_334" width="57" height="57"
                                                        xlink:href="data:image/png;base64,...(same as original)..." />
                                                </defs>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-6">
                                <div style="border: 0.73px solid #F12117; border-radius: 5px;">
                                    <div class="row" style="padding: 5px;">
                                        <div class="col-8">
                                            <p style="font-size: 12px; margin-bottom: 0px; color: #F12117;">Overdue Tasks
                                            </p>
                                            <p id="overdueTasksCount"
                                                style="font-size: 20px; font-weight: bold; color: #F12117; margin-bottom: 0px;">
                                                {{ $overdueTasks }}
                                            </p>
                                        </div>
                                        <div class="col-4"
                                            style="display: flex; align-items: center; justify-content: center;">
                                            <svg width="40" viewBox="0 0 52 52" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <rect x="0.409668" y="0.212891" width="50.8743" height="50.8743"
                                                    fill="url(#pattern0_246_337)" />
                                                <defs>
                                                    <pattern id="pattern0_246_337" patternContentUnits="objectBoundingBox"
                                                        width="1" height="1">
                                                        <use xlink:href="#image0_246_337" transform="scale(0.0175439)" />
                                                    </pattern>
                                                    <image id="image0_246_337" width="57" height="57"
                                                        xlink:href="data:image/png;base64,...(same as original)..." />
                                                </defs>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div style="border: 0.73px solid #5e6c84; border-radius: 5px;">
                                    <div class="row" style="padding: 5px;">
                                        <div class="col-8">
                                            <p style="font-size: 12px; margin-bottom: 0px; color: #5e6c84;">Todo Tasks</p>
                                            <p id="todoTasksCount"
                                                style="font-size: 20px; font-weight: bold; color: #5e6c84; margin-bottom: 0px;">
                                                {{ $todoTasks }}
                                            </p>
                                        </div>
                                        <div class="col-4"
                                            style="display: flex; align-items: center; justify-content: center;">
                                            <svg width="40" viewBox="0 0 52 52" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <rect x="0.409668" y="0.212891" width="50.8743" height="50.8743"
                                                    fill="url(#pattern0_246_338)" />
                                                <defs>
                                                    <pattern id="pattern0_246_338" patternContentUnits="objectBoundingBox"
                                                        width="1" height="1">
                                                        <use xlink:href="#image0_246_338" transform="scale(0.0175439)" />
                                                    </pattern>
                                                    <image id="image0_246_338" width="57" height="57"
                                                        xlink:href="data:image/png;base64,...(same as original)..." />
                                                </defs>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-grow-1 p-3 d-flex align-items-stretch" style="min-width: 350px;">
                    <div class="w-100 rounded d-flex align-items-center justify-content-center"
                        style="background-color: #F4F4F4; height: 100%; min-height: 225px;">
                        <canvas id="project-bar-chart" style="height: 100%; width: 100%;"></canvas>
                    </div>
                </div>
            </div>
            <div class="row pb-3 rounded" style="background-color: #F4F4F4; padding: 15px;">
                <div class="d-flex flex-wrap justify-content-between align-items-end w-100">
                    <div class="d-flex flex-wrap align-items-end gap-3">
                        <div class="d-flex flex-column">
<div id="project-filter-wrapper" style="min-width: 180px;">
    <select id="projectFilter" class="form-select form-select-sm" style="min-width: 180px;">
        <option value="all" selected>All</option>
        @foreach ($projects as $project)
            <option value="{{ $project->id }}">{{ $project->name }}</option>
        @endforeach
    </select>
</div>

                        </div>
                        <div class="d-flex align-items-end">
                            <button id="upcoming" class="btn btn-outline-primary btn-sm px-3">Upcoming Deadlines</button>
                        </div>
                        <div class="d-flex align-items-end">
                            <button id="overdue" class="btn btn-outline-primary btn-sm px-3">Overdue Tasks</button>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap align-items-end gap-3">
                        <div class="d-flex flex-column">
                            <label for="min-date" class="form-label small fw-bold text-muted mb-1">From</label>
                            <input type="date" id="min-date" class="form-control form-control-sm"
                                style="width: 150px;">
                        </div>
                        <div class="d-flex flex-column">
                            <label for="max-date" class="form-label small fw-bold text-muted mb-1">To</label>
                            <input type="date" id="max-date" class="form-control form-control-sm"
                                style="width: 150px;">
                        </div>
                        <div class="d-flex align-items-end">
                            <button id="clear-date-filter" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-times-circle me-1"></i> Clear
                            </button>
                        </div>
                        <div class="btn-group align-items-end" role="group">
                            <button class="btn btn-sm btn-outline-primary" onclick="showContent('content1')"
                                title="List View">
                                <i class="far fa-list-alt me-1"></i> List
                            </button>
                            <button class="btn btn-sm btn-outline-primary" onclick="showContent('content2')"
                                title="Grid View">
                                <i class="fas fa-th-large me-1"></i> Board
                            </button>
                                 <button class="btn btn-sm btn-outline-primary" onclick="showContent('content3')"
                                title="Grid View">
                                <i class="fas fa-th-large me-1"></i> Gant
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 tab-pane board-tab fade h-screen-90 content" style="margin-bottom: 10px;" id="content1">
                <div class="col-lg-12 p-3 mb-3 rounded" style="background-color: #F4F4F4;">
                    <table id="projects-table" class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                <th style="color: #0C5097; font-weight: bold;">Project</th>
                                <th style="color: #0C5097; font-weight: bold;">Resource</th>
                                <th style="color: #0C5097; font-weight: bold;">Task</th>
                                <th style="color: #0C5097; font-weight: bold;">Start Date</th>
                                <th style="color: #0C5097; font-weight: bold;">Due Date</th>
                                <th style="color: #0C5097; font-weight: bold;">Exp Days</th>
                                <th style="color: #0C5097; font-weight: bold;">Days Used</th>
                                <th style="color: #0C5097; font-weight: bold;">Status</th>
                                <th style="color: #0C5097; font-weight: bold;">Priority</th>
                                <th style="color: #0C5097; font-weight: bold;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tasks as $task)
                                <tr class="project-row" data-project-id="{{ $task->project_id }}">
                                    {{--  <td style="font-size: 12px;">{{ $task->project->name }}</td>
                                                            <button type="button"
                                                class="btn btn-edit-project"
                                                style="background:#0C5097; color:white"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editMainProjectModal"
                                                data-project='@json($project)'>
                                                {{ $project->name }}
                                            </button>  --}}
                                            <td style="font-size: 12px; cursor:pointer; color:#0C5097;"
    class="open-edit-project-modal"
    data-project-id="{{ $task->project->id }}">
    {{ $task->project->name }}
</td>
                                    <td style="font-size: 12px;">{{ $task->assignee->name ?? 'Unassigned' }}</td>
                                    <td style="font-size: 12px; cursor: pointer;" class="project-name"
                                        data-id="{{ $task->id }}" data-bs-toggle="modal"
                                        data-bs-target="#statusHistoryModal">
                                        {{ $task->title }}
                                    </td>
                                    <td style="font-size: 12px;">
                                        {{ $task->project->start_date ? \Carbon\Carbon::parse($task->project->start_date)->format('d, M Y') : '—' }}
                                        <input type="hidden" class="hidden-start-date"
                                            value="{{ $task->project->start_date ? \Carbon\Carbon::parse($task->project->start_date)->format('Y-m-d') : '' }}">
                                    </td>
                                    <td style="font-size: 12px;">
                                        {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d, M Y') : '—' }}
                                        <input type="hidden" class="hidden-due-date"
                                            value="{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '' }}">
                                    </td>
                                    <td style="font-size: 12px;">{{ $task->expected_days ?? '—' }}</td>
                                    <td style="font-size: 12px;">{{ $task->days_used ?? '—' }}</td>
                                    <td class="text-center">
                                        <span
                                            class="
                                            {{ $task->status == 'todo' ? 'bg-primary' : '' }}
                                            {{ $task->status == 'in_progress' ? 'bg-info' : '' }}
                                            {{ $task->status == 'done' ? 'bg-success' : '' }}
                                            badge"
                                            style="font-size: 12px; width: 100px; padding: 0.25rem;">
                                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                        </span>
                                    </td>
                                    <td style="font-size: 12px;">
                                        <span class="badge"
                                            style="background-color: {{ $task->priority == 'high' ? '#dc3545' : ($task->priority == 'medium' ? '#ffc107' : '#28a745') }};">
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="#" style="text-decoration: none" class="edit-btn"
                                            data-id="{{ $task->id }}" data-bs-toggle="modal"
                                            data-bs-target="#editProjectModal">
                                            <i class="fas fa-edit" style="font-size: 16px; color: #ffc107;"></i>
                                        </a>
                                        <a href="#" style="text-decoration: none" class="view-btn"
                                            data-id="{{ $task->id }}" data-bs-toggle="modal"
                                            data-bs-target="#viewProjectModal">
                                            <i class="fas fa-eye" style="font-size: 16px; color: #0C5097;"></i>
                                        </a>
                                        <a href="#" style="text-decoration: none" class="delete-btn"
                                            data-id="{{ $task->id }}">
                                            <i class="fas fa-trash-alt" style="font-size: 16px; color: #dc3545;"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10">No Tasks</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane board-tab fade h-screen-90 content" id="content2" style="margin-bottom: 10px;">
                <div class="task-board-wrapper">
                    <div class="task-board-container">
                        <div class="task-board d-flex flex-nowrap">
                            @php
                                $statuses = [
                                    'todo' => ['name' => 'To Do', 'color' => '#5e6c84'],
                                    'in_progress' => ['name' => 'In Progress', 'color' => '#00b8d9'],
                                    'on_hold' => ['name' => 'On Hold', 'color' => '#ffc107'],
                                    'done' => ['name' => 'Done', 'color' => '#5aac44'],
                                ];
                            @endphp
                            @foreach ($statuses as $status => $config)
                                <div class="col-3 project-col {{ $status }}-col pl-2 pr-2">
                                    <div class="col-content"
                                        id="{{ $status == 'todo' ? 'RikyasTodoTasks' : ($status == 'in_progress' ? 'RikyasInProgressTasks' : ($status == 'on_hold' ? 'RikyasOnHoldTasks' : 'RikyasCompletedTasks')) }}"
                                        style="background-color: #fff; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); height: 100%; display: flex; flex-direction: column;">
                                        <h5 class="text-center py-2 mb-0"
                                            style="background-color: {{ $config['color'] }}; color: white; border-radius: 5px 5px 0 0;">
                                            {{ $config['name'] }}
                                        </h5>
                                        <ul class="project-list {{ $status }} p-3"
                                            data-status="{{ $status }}"
                                            style="list-style: none; margin: 0; border-top: 1px solid #ddd; overflow-y: auto; flex-grow: 1;">
                                            @foreach ($tasks->where('status', $status) as $task)
                                                <li class="project-list-item mb-3" data-id="{{ $task->id }}"
                                                    data-project-id="{{ $task->project_id }}"
                                                    style="background-color: #f9f9f9; border-radius: 5px; padding: 10px; border: 1px solid #ddd;">
                                                    <div
                                                        class="list-item-header d-flex justify-content-between align-items-center">
                                                        <div class="task-assign-to">
                                                            <span
                                                                class="project-name v-align-middle name-{{ $status }} capitalize selected-project"
                                                                style="cursor: pointer; font-weight: bold;"
                                                                data-id="{{ $task->id }}" data-bs-toggle="modal"
                                                                data-bs-target="#statusHistoryModal">
                                                                {{ $task->title }}
                                                            </span>
                                                        </div>
                                                        <div class="collapse-task">
                                                            <span class="d-inline-block tooltip-customize"
                                                                data-bs-toggle="tooltip" title="Toggle Task Details">
                                                                <i class="fas fa-chevron-down fw-bold collapse-panel-arrow collapse-task-trigger"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#taskCollapse{{ $task->id }}"
                                                                    aria-expanded="false"
                                                                    aria-controls="taskCollapse{{ $task->id }}"
                                                                    data-toggle-icon></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="task-meta mt-2 mb-2"
                                                        style="font-size: 12px; color: #666;">
                                                        <i class="far fa-calendar-alt me-1"></i>
                                                        @if ($task->project->start_date && $task->due_date)
                                                            {{ \Carbon\Carbon::parse($task->project->start_date)->format('M d') }}
                                                            -
                                                            {{ \Carbon\Carbon::parse($task->due_date)->format('M d') }}
                                                            ({{ $task->expected_days ?? 'N/A' }} days)
                                                        @elseif ($task->due_date)
                                                            Due:
                                                            {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                                        @else
                                                            Start:
                                                            {{ $task->project->start_date ? \Carbon\Carbon::parse($task->project->start_date)->format('M d, Y') : 'N/A' }}
                                                        @endif
                                                    </div>
                                                    <div class="collapse project-list-collapse p-2"
                                                        id="taskCollapse{{ $task->id }}">
                                                        <div class="list-content" style="color: #333; font-size: 14px;">
                                                            <div><strong>Task:</strong> {{ $task->title }}</div>
                                                            <div><strong>Project:</strong> {{ $task->project->name }}</div>
                                                            <div><strong>Assigned To:</strong>
                                                                {{ $task->assignee->name ?? 'Unassigned' }}</div>
                                                            <div><strong>Priority:</strong>
                                                                <span class="badge"
                                                                    style="background-color: {{ $task->priority == 'high' ? '#dc3545' : ($task->priority == 'medium' ? '#ffc107' : '#28a745') }};">
                                                                    {{ ucfirst($task->priority) }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="list-footer d-flex align-items-center justify-content-between mt-2">
                                                            <div></div>
                                                            <div>
                                                                <small class="text-muted">Created by:
                                                                    {{ $task->project->creator->name }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
                <div class="tab-pane board-tab fade h-screen-90 content" id="content3" style="margin-bottom: 10px;">
     <!-- Filters -->
    <div class="row mb-2 align-items-center" style="width:100%;">
        <div class="col-md-3">
            <label for="filter-from" class="form-label mb-1">From</label>
            <input type="date" id="filter-from" class="form-control form-control-sm" />
        </div>
        <div class="col-md-3">
            <label for="filter-to" class="form-label mb-1">To</label>
            <input type="date" id="filter-to" class="form-control form-control-sm" />
        </div>
        <div class="col-md-4">
            <label for="filter-resource" class="form-label mb-1">Resources</label>
            <select id="filter-resource" class="form-select form-select-sm">
                <option value="">Select Resources</option>
                @foreach($users as $user)
                    <option value="{{ $user->name }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button id="filter-search" class="btn btn-dark btn-sm mt-4 p-2 w-100"><i class="fas fa-search"></i></button>
        </div>
    </div>
                    <div class="container">
   
    <div style="display: flex; width: 100%; height: 600px;">
        <!-- Left Side: Tasks & Resources Table -->
        <table class="task-table" style="width:30%;">
            <thead>
                <tr>
                    <th>Tasks</th>
                    <th>Resources</th>
                </tr>
            </thead>
            <tbody id="taskTableBody"></tbody>
        </table>
        <!-- Right Side: Chart -->
        <div class="chart-container" style="width:70%;">
            <canvas id="ganttChart"></canvas>
        </div>
    </div>
  </div>
            </div>
        </div>
<div class="modal fade" id="subTaskModal" tabindex="-1" aria-labelledby="subTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="subTaskModalLabel">Add Sub Task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="subTaskForm">
          <input type="hidden" id="task_id" name="task_id">

          <div class="mb-3">
            <label for="task_name" class="form-label">Parent Task</label>
            <input type="text" class="form-control" id="task_name" name="task_name" readonly>
          </div>

          <div class="mb-3">
            <label for="title" class="form-label">Sub Task Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
          </div>

          <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select" required>
            <option value="not_started">Not Started</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
        </select>
    </div>
          <button type="submit" class="btn btn-primary">Save Sub Task</button>
        </form>
      </div>
    </div>
  </div>
</div>
{{--  {{ dd($tasks) }}  --}}

        <!-- Add Project Modal -->
        <div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header"
                        style="background: linear-gradient(90deg, #0C5097, #1A73E8); color: white; border-radius: 10px 10px 0 0;">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Project</h1>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="store-error-messages" class="alert alert-danger d-none"></div>
                        <form data-route="{{ route('project.store') }}" method="POST" id="project-form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="project_name" class="col-form-label">Project Name:</label>
                                    <input type="text" class="form-control" id="project_name" name="name"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="created_by" class="col-form-label">Project Owner:</label>
                                    <select class="form-control" id="created_by" name="created_by" required>
                                        <option value="">Select Owner</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <label for="description" class="col-form-label">Project Description:</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="start_date" class="col-form-label">Start Date:</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date">
                                </div>
                                <div class="col-md-4">
                                    <label for="end_date" class="col-form-label">End Date:</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date">
                                </div>
                                <div class="col-md-4">
                                    <label for="status" class="col-form-label">Status:</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="not_started">Not Started</option>
                                        <option value="in_progress">In Progress</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>
                            </div>
                            <hr class="my-4">
                            <h5 class="mb-2">Tasks</h5>
                            <div id="tasks-section">
                                <div class="task-row row g-0 align-items-end">
                                    <div class="col-md-3 pe-1">
                                        <input type="text" class="form-control form-control-sm" name="tasks[0][title]"
                                            placeholder="Task Title" required>
                                    </div>
                                    <div class="col-md-3 px-1">
                                        <input type="text" class="form-control form-control-sm"
                                            name="tasks[0][description]" placeholder="Task Description">
                                    </div>
                                    <div class="col-md-2 px-1">
                                        <select class="form-control form-control-sm" name="tasks[0][assigned_to]">
                                            <option value="">Assign To</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 px-1">
                                        <select class="form-control form-control-sm" name="tasks[0][priority]">
                                            <option value="medium">Medium</option>
                                            <option value="low">Low</option>
                                            <option value="high">High</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 px-1">
                                        <input type="date" class="form-control form-control-sm"
                                            name="tasks[0][due_date]">
                                    </div>
                                    <div class="col-md-1 ps-1 d-flex align-items-center">
                                        <button type="button" class="btn btn-danger btn-sm remove-task"
                                            onclick="removeTaskRow(this)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm mt-3" onclick="addTaskRow()">+
                                Add Task</button>
                            <div class="modal-footer mt-4">
                                <button type="button" class="btn btn-secondary btn-sm"
                                    data-bs-dismiss="modal">Close</button>
                                <button id="store-project-btn" type="submit"
                                    class="btn btn-primary btn-sm">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<!-- 🔹 Task Info Modal -->
<div class="modal fade" id="taskInfoModal" tabindex="-1" aria-labelledby="taskInfoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="taskInfoModalLabel">Task Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <p><strong>Task ID:</strong> <span id="modalTaskId"></span></p>
        <p><strong>Task Name:</strong> <span id="modalTaskName"></span></p>

        <!-- ✅ Documents List -->
        <div id="documentList" class="mt-3"></div>
      </div>

      <div class="modal-footer">
        <input type="file" id="uploadDocumentInput" hidden>
        <button type="button" class="btn btn-primary" id="uploadDocumentBtn">Upload Document</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




        <div class="modal fade" id="editMainProjectModal" tabindex="-1" aria-labelledby="editMainProjectLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background:linear-gradient(90deg,#0C5097,#1A73E8);color:white;border-radius:10px 10px 0 0;">
                <h1 class="modal-title fs-5" id="editMainProjectLabel">Edit Project</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="edit-project-form" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="edit_project_id" name="id">

                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-form-label">Project Name:</label>
                            <input type="text" class="form-control" id="edit_project_name" name="name" required>
                        </div>

                        <div class="col-md-6">
                            <label class="col-form-label">Project Owner:</label>
                            <select class="form-control" id="edit_created_by" name="created_by" required>
                                <option value="">Select Owner</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <label class="col-form-label mt-2">Project Description:</label>
                    <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label class="col-form-label">Start Date:</label>
                            <input type="date" class="form-control" id="edit_start_date" name="start_date">
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label">End Date:</label>
                            <input type="date" class="form-control" id="edit_end_date" name="end_date">
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label">Status:</label>
                            <select class="form-control" id="edit_status" name="status">
                                <option value="not_started">Not Started</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>

                    <hr class="my-4">
                    <h5>Tasks</h5>
                    <div id="edit-tasks-section"></div>

                    <!-- Add Task Button -->
                    <button type="button" class="btn btn-outline-primary btn-sm mt-3" id="addEditTaskBtn">+ Add Task</button>

                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Update Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


        <!-- Edit Task Modal -->
        <div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" style="max-width: 900px;">
                <div class="modal-content">
                    <div class="modal-header"
                        style="background: linear-gradient(90deg, #0C5097, #1A73E8); color: white; border-radius: 10px 10px 0 0; padding: 1.5rem;">
                        <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Update Task</h1>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="card shadow-sm"
                            style="border: 1px solid #e9ecef; border-radius: 0 0 8px 8px; background: #ffffff;">
                            <div class="card-body p-4">
                                <div id="update-error-messages" class="alert alert-danger d-none mb-4"></div>
                                <form id="update-project-form" action="#" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="task_id" id="edit_task_id">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label for="edit_project_id"
                                                class="form-label text-muted fw-semibold">Project</label>
                                            <select class="form-select" id="edit_project_id" name="project_id" required>
                                                <option value="">Select Project</option>
                                                @foreach ($tasks->pluck('project')->unique('id') as $project)
                                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="edit_assigned_to"
                                                class="form-label text-muted fw-semibold">Assigned To</label>
                                            <select class="form-select" id="edit_assigned_to" name="assigned_to">
                                                <option value="">Unassigned</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="edit_title" class="form-label text-muted fw-semibold">Task
                                                Title</label>
                                            <input type="text" class="form-control" id="edit_title" name="title"
                                                required>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <label for="edit_description" class="form-label text-muted fw-semibold">Task
                                            Description</label>
                                        <textarea class="form-control" id="edit_description" name="description" rows="4"></textarea>
                                    </div>
                                    <div class="row g-3 mt-4">
                                        <div class="col-md-4">
                                            <label for="edit_due_date" class="form-label text-muted fw-semibold">Due
                                                Date</label>
                                            <input type="date" class="form-control" id="edit_due_date"
                                                name="due_date">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="edit_status"
                                                class="form-label text-muted fw-semibold">Status</label>
                                            <select class="form-select" id="edit_status" name="status" required>
                                                <option value="todo">To Do</option>
                                                <option value="in_progress">In Progress</option>
                                                <option value="done">Done</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="edit_priority"
                                                class="form-label text-muted fw-semibold">Priority</label>
                                            <select class="form-select" id="edit_priority" name="priority" required>
                                                <option value="low">Low</option>
                                                <option value="medium">Medium</option>
                                                <option value="high">High</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent border-top-0 mt-4 p-0">
                                        <div class="d-flex justify-content-end gap-2">
                                            <button type="button" class="btn btn-secondary btn-sm"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-sm"
                                                id="update-project-btn">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Task Modal -->
        <div class="modal fade" id="viewProjectModal" tabindex="-1" aria-labelledby="viewProjectLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">
                    <div class="modal-header"
                        style="background: linear-gradient(90deg, #0C5097, #1A73E8); color: white; border-radius: 10px 10px 0 0; padding: 20px;">
                        <h1 class="modal-title fs-4 fw-bold" id="viewProjectLabel">Task Details</h1>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="padding: 2rem; background: #f8fafc;">
                        <div class="card mb-4 shadow-sm"
                            style="border: 1px solid #e9ecef; border-radius: 8px; background: #ffffff;">
                            <div class="card-body p-3">
                                <h3 class="h5 fw-bold text-primary mb-2" id="view-task-title"></h3>
                                <div class="d-flex align-items-center gap-3">
                                    <span id="view-task-status" class="badge rounded-pill"
                                        style="padding: 0.5rem 1rem; font-size: 0.875rem;"></span>
                                    <span class="text-muted mx-2">•</span>
                                    <span id="view-task-priority" class="d-flex align-items-center badge rounded-pill"
                                        style="padding: 0.5rem 1rem; font-size: 0.875rem;">
                                        <i class="fas fa-exclamation-circle me-1"></i> <span></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card shadow-sm"
                                    style="border: 1px solid #e9ecef; border-radius: 8px; background: #ffffff;">
                                    <div class="card-body p-3">
                                        <h6 class="text-muted fw-semibold mb-3">PROJECT</h6>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3"
                                                style="width: 40px; height: 40px; background: #e9ecef; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-folder" style="color: #6c757d;"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-medium" id="view-task-project"></p>
                                                <small class="text-muted">Project Name</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow-sm"
                                    style="border: 1px solid #e9ecef; border-radius: 8px; background: #ffffff;">
                                    <div class="card-body p-3">
                                        <h6 class="text-muted fw-semibold mb-3">ASSIGNED TO</h6>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3"
                                                style="width: 40px; height: 40px; background: #e9ecef; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-user" style="color: #6c757d;"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-medium" id="view-task-assigned-to"></p>
                                                <small class="text-muted">Assigned Resource</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card shadow-sm"
                                    style="border: 1px solid #e9ecef; border-radius: 8px; background: #ffffff;">
                                    <div class="card-body p-3">
                                        <h6 class="text-muted fw-semibold mb-4">TASK TIMELINE</h6>
                                        <div class="d-flex justify-content-between">
                                            <div class="text-center flex-grow-1">
                                                <div class="text-primary fw-semibold mb-2">Start Date</div>
                                                <p class="mb-0" id="view-task-start-date"></p>
                                            </div>
                                            <div class="text-center flex-grow-1"
                                                style="border-left: 1px solid #dee2e6; border-right: 1px solid #dee2e6;">
                                                <div class="fw-semibold mb-2" id="due-date-label">Due Date</div>
                                                <p class="mb-0" id="view-task-due-date"></p>
                                            </div>
                                            <div class="text-center flex-grow-1">
                                                <div class="text-success fw-semibold mb-2">Completed At</div>
                                                <p class="mb-0" id="view-task-completed-at"></p>
                                            </div>
                                        </div>
                                        <div class="progress mt-3" style="height: 6px;">
                                            <div class="progress-bar bg-primary" role="progressbar"
                                                id="view-task-progress" aria-valuenow="0" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card shadow-sm"
                                    style="border: 1px solid #e9ecef; border-radius: 8px; background: #ffffff;">
                                    <div class="card-body p-3">
                                        <h6 class="text-muted fw-semibold mb-3">TASK DESCRIPTION</h6>
                                        <p class="mb-0" id="view-task-description" style="line-height: 1.6;"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status History Modal -->
        <div class="modal fade" id="statusHistoryModal" tabindex="-1" aria-labelledby="viewProjectLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 950px;">
                <div class="modal-content" style="border-radius: 12px; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);">
                    <div class="modal-header"
                        style=" border-radius: 12px 12px 0 0; padding: 1.5rem;">
                        <div class="d-flex flex-column w-100">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class=" ">
                                    <p class="badge bg-light text-dark projectId"
                                        style="font-size: 0.875rem; padding: 0.25rem 0.5rem; font-weight: 500;">#0000</p>
                         <h5 class="modal-title mb-0 projectTitle"
                                        style="font-size: 1.25rem; font-weight: 700; color: #0C5097;">Task Title</h5>
                                </div>
                                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="d-flex align-items-center mt-3 gap-4">
                                <div class="d-flex align-items-center text-sm">
                                    <i class="fas fa-tag me-2" style="font-size: 0.875rem; color: #0C5097;"></i>
                                    <span id="priority" class="badge bg-warning text-dark small"
                                        style="padding: 0.25rem 0.75rem; font-weight: 500;">Priority</span>
                                </div>
                                <div class="d-flex align-items-center text-sm">
                                    <i class="fas fa-clock me-2" style="font-size: 0.875rem; color: #0C5097;"></i>
                                    <small class="projectPostedDate" style="font-size: 0.8125rem; color: #0C5097;">Posted
                                        on: --</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body p-0" style="background: #ffffff;">
                        <div class="d-flex h-100" style="min-height: 60vh;">
                            <!-- Left Panel: Project Details -->
                            <div class="col-md-4 p-0">
                                <div class="bg-gray-50 p-4" style="border-right: 1px solid #e5e7eb; min-height: 100%;">
                                    <div class="project-details space-y-4">
                                        <div class="">
                                            <label
                                                class="text-gray-500 text-sm mb-2 d-flex align-items-center ">
                                                <i class="fas fa-user me-2 text-blue-600"
                                                    style="font-size: 0.875rem;"></i>Created By
                                            </label>
                                            <div class="fw-medium createdBy text-start"
                                                style="font-size: 0.9375rem; color: #1f2937;">--</div>
                                        </div>
                                        <div class="">
                                            <label
                                                class="text-gray-500 text-sm mb-2 ">
                                                <i class="fas fa-user-check me-2 text-blue-600"
                                                    style="font-size: 0.875rem;"></i>Assigned To
                                            </label>
                                            <div class="fw-medium assignedTo text-start"
                                                style="font-size: 0.9375rem; color: #1f2937;">--
                                            </div>
                                        </div>
                                        <div class="row  mb-3">
                                            <div class="col-12 mb-3">
                                                <label
                                                    class="text-gray-500 text-sm mb-2 d-flex align-items-center ">
                                                    <i class="far fa-calendar me-2 text-blue-600"
                                                        style="font-size: 0.875rem;"></i>Start Date
                                                </label>
                                                <div class="fw-medium startDate text-start"
                                                    style="font-size: 0.9375rem; color: #1f2937;">--
                                                </div>
                                            </div>
                                            <div class="col-12  ">
                                                <label
                                                    class="text-gray-500 text-sm mb-2  ">
                                                    <i class="far fa-calendar-check me-2 text-blue-600"
                                                        style="font-size: 0.875rem;"></i>Due Date
                                                </label>
                                                <div class="fw-medium dueDate text-start"
                                                    style="font-size: 0.9375rem; color: #1f2937;">--
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-12 ">
                                                <label
                                                    class="text-gray-500 text-sm mb-2 ">
                                                    <i class="fas fa-clock me-2 text-blue-600"
                                                        style="font-size: 0.875rem;"></i>Expected Days
                                                </label>
                                                <div class="fw-medium expectedDays text-start"
                                                    style="font-size: 0.9375rem; color: #1f2937;">--
                                                </div>
                                            </div>
                                            <div class="col-12 ">
                                                <label
                                                    class="text-gray-500 text-sm mb-2 ">
                                                    <i class="fas fa-hourglass-half me-2 text-blue-600"
                                                        style="font-size: 0.875rem;"></i>Days Used
                                                </label>
                                                <div class="fw-medium daysUsed text-start"
                                                    style="font-size: 0.9375rem; color: #1f2937;">--
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label
                                                class="text-gray-500 text-sm mb-2  ">
                                                <i class="fas fa-info-circle me-2 text-blue-600"
                                                    style="font-size: 0.875rem;"></i>Status
                                            </label>
                                       <div class="text-start">
                                             <div class="badge projectStatus text-start"
                                                style="font-size: 0.8125rem; padding: 0.375rem 0.75rem; background-color: #10b981; color: white; border-radius: 16px;">
                                                --
                                            </div>
                                       </div>
                                        </div>
                                        <div class="">
                                            <label
                                                class="text-gray-500 text-sm mb-2 ">
                                                <i class="fas fa-exclamation-circle me-2 text-blue-600"
                                                    style="font-size: 0.875rem;"></i>Priority
                                            </label>
                                               <div class="text-start">
                                            <div class="badge priority"
                                                style="font-size: 0.8125rem; padding: 0.375rem 0.75rem; background-color: #f59e0b; color: white; border-radius: 16px;">
                                                --
                                            </div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Right Panel: Description and Tabs -->
                            <div class="col-md-8 p-0">
                                <div class="p-4 d-flex flex-column h-100">
                                    <div class="card mb-4"
                                        style="border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); flex-shrink: 0;">
                                        <div class="card-body p-4">
                                            <h6 class="text-gray-500 mb-3" style="font-size: 1rem; font-weight: 600;">
                                                Description</h6>
                                            <div class="description-content projectDescription"
                                                style="max-height: 180px; overflow-y: auto; font-size: 0.875rem; line-height: 1.75; color: #4b5563; background: #f9fafb; padding: 0.75rem; border-radius: 8px;">
                                                <p id="descriptionText" class="mb-0"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="nav nav-tabs" role="tablist"
                                        style="border-bottom: 1px solid #e5e7eb; margin-bottom: 1.25rem;">
                                        <li class="nav-item">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#TaskComments">
                                                <i class="fas fa-comments me-2"></i>Comments
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#TaskStatus">
                                                <i class="fas fa-history me-2"></i>Status History
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content flex-grow-1" style="min-height: 0; position: relative;">
                                        <div class="tab-pane fade show active" id="TaskComments"
                                            style="display: flex; flex-direction: column; height: 100%; background: #ffffff;">
                                            <div class="comments-container card" id="commentsContainer"
                                                style="max-height: 250px; overflow-y: auto; border: none; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); padding: 0.9375rem; background: #f9fafb; flex-grow: 1;">
                                            </div>
                                            <div class="comment-input mt-4" style="flex-shrink: 0;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control comment-input-field"
                                                        placeholder="Add a comment..."
                                                        style="border-radius: 8px 0 0 8px; font-size: 0.875rem; border-color: #d1d5db;">
                                                    <button class="btn btn-primary submit-comment"
                                                        style="border-radius: 0 8px 8px 0; font-size: 0.875rem; background: #0C5097; border: none; padding: 0.5rem 1rem; transition: background 0.3s ease;">
                                                        <i class="fas fa-paper-plane"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="TaskStatus"
                                            style="display: flex; flex-direction: column; height: 100%;background: #ffffff;">
                                            <div id="statusHistory" class="table-responsive"
                                                style="max-height: 250px; overflow-y: auto; flex-grow: 1;">
                                                <table class="table table-hover table-borderless">
                                                    <thead
                                                        style="position: sticky; top: 0; background: #ffffff; font-size: 0.875rem; color: #374151; border-bottom: 1px solid #e5e7eb; z-index: 1;">
                                                        <tr>
                                                            <th style="padding: 0.75rem;">Status</th>
                                                            <th style="padding: 0.75rem;">Priority</th>
                                                            <th style="padding: 0.75rem;">Date</th>
                                                            <th style="padding: 0.75rem;">Updated By</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="statusHistoryBody"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    //////////////////////////////////////////////////////
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ✅ Setup CSRF Token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });

    // ✅ When "Sub Task" button clicked, fill modal fields
    $(document).on('click', '.open-subtask-modal', function () {
        const taskId = $(this).data('task-id');
        const taskName = $(this).data('task-name');

        $('#task_id').val(taskId);
        $('#task_name').val(taskName);
    });

    // ✅ Submit form via AJAX
    $('#subTaskForm').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: '/sub-tasks',
            method: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                alert('Sub Task added successfully!');
                $('#subTaskModal').modal('hide');
                $('#subTaskForm')[0].reset();
            },
            error: function (xhr) {
                if (xhr.status === 419) {
                    alert('CSRF token mismatch — please refresh the page.');
                } else {
                    alert('Error: ' + (xhr.responseJSON?.message || 'Something went wrong'));
                }
            }
        });
    });

});
</script>
    <script>
        window.AppRoutes = {
            graph: @json(route('project.graph')),
            taskShow: @json(route('task.show', ['task' => ':id'])),
            taskEdit: @json(route('task.edit', ['task' => ':id'])),
            taskStore: @json(route('task.store')),
            taskUpdate: @json(route('task.update', ['task' => ':id'])),
            taskDelete: @json(route('task.destroy', ['task' => ':id'])),
            taskUpdateStatus: @json(route('task.update.status', ['task' => ':id'])),
            commentStore: @json(route('comment.store', ['task' => ':id'])),
            fetchTasks: @json(route('fetch.tasks')),
            csrfToken: @json(csrf_token())
        };
    </script>
    <script src="{{ asset('js/project.js') }}"></script>
        <!-- Google Charts Loader -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
<script>
$(document).ready(function () {
    let currentTaskId = null;

    // 🔹 Load documents when modal opens
    $('#taskInfoModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const taskId = button.data('task-id');
        const taskName = button.data('task-name');

        currentTaskId = taskId;
        $('#modalTaskId').text(taskId);
        $('#modalTaskName').text(taskName);
        $('#documentList').html('<p class="text-muted">Loading documents...</p>');

        loadDocuments(taskId);
    });

    // 🔹 Open file picker
    $('#uploadDocumentBtn').on('click', function () {
        $('#uploadDocumentInput').click();
    });

    // 🔹 Upload document
    $('#uploadDocumentInput').on('change', function (e) {
        if (!currentTaskId) return;

        let file = e.target.files[0];
        let formData = new FormData();
        formData.append('task_id', currentTaskId);
        formData.append('document', file);

        $.ajax({
            url: '/tasks/documents',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#uploadDocumentInput').val('');
                renderDocuments(response.documents);
            },
            error: function (xhr) {
                console.error('Upload error:', xhr.responseText);
                alert('Upload failed.');
            }
        });
    });

    // 🔹 Load documents function
    function loadDocuments(taskId) {
        $.ajax({
            url: `/tasks/${taskId}/documents`,
            type: 'GET',
            success: function (response) {
                renderDocuments(response.documents);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                $('#documentList').html('<p class="text-danger">Failed to load documents.</p>');
            }
        });
    }

    // 🔹 Render documents (with Download + Delete buttons)
    function renderDocuments(documents) {
        if (!documents || documents.length === 0) {
            $('#documentList').html('<p class="text-muted">No documents uploaded yet.</p>');
            return;
        }

        let html = '<ul class="list-group">';
        documents.forEach(doc => {
            let fileName = doc.document_path.split('/').pop();
            html += `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <a href="/storage/${doc.document_path}" target="_blank">${fileName}</a>
                        <small class="text-muted d-block">by ${doc.uploaded_by}</small>
                    </div>
                    <div>
                        <a href="/storage/${doc.document_path}" download class="btn btn-sm btn-success me-2">
                            <i class="bi bi-download"></i> Download
                        </a>
                        <button class="btn btn-sm btn-danger delete-doc-btn" data-id="${doc.id}">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </div>
                </li>`;
        });
        html += '</ul>';

        $('#documentList').html(html);
    }

    // 🔹 Delete document
    $(document).on('click', '.delete-doc-btn', function () {
        const docId = $(this).data('id');
        if (!confirm('Are you sure you want to delete this document?')) return;

        $.ajax({
            url: `/tasks/documents/${docId}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                renderDocuments(response.documents);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('Failed to delete document.');
            }
        });
    });
});
</script>





<script>
    document.addEventListener('DOMContentLoaded', function() {
        showContent('content1');
    });

    var allTasks = @json($tasks);

    // ✅ Filter function (now includes project filter)
    function getFilteredTasks() {
        var from = document.getElementById('filter-from')?.value;
        var to = document.getElementById('filter-to')?.value;
        var resource = document.getElementById('filter-resource')?.value;
        var selectedProject = document.getElementById('projectFilter')?.value;

        return allTasks.filter(function(task) {
            var match = true;

            var start = task.project && task.project.start_date ? new Date(task.project.start_date) : null;
            var end = task.due_date ? new Date(task.due_date) : null;

            // ✅ Project filter
            if (selectedProject && selectedProject !== 'all') {
                match = match && task.project_id == selectedProject;
            }

            if (from) {
                if (start) {
                    match = match && start >= new Date(from);
                } else {
                    match = false;
                }
            }

            if (to) {
                if (end) {
                    match = match && end <= new Date(to);
                } else {
                    match = false;
                }
            }

            if (resource) {
                if (task.assignee && task.assignee.name) {
                    match = match && task.assignee.name === resource;
                } else {
                    match = false;
                }
            }

            return match;
        });
    }

    function renderTable(tasks) {
        var tableBody = document.getElementById('taskTableBody');
        if (tableBody) {
            tableBody.innerHTML = '';
            tasks.forEach(function(task) {
                var tr = document.createElement('tr');
                var tdTask = document.createElement('td');
                tdTask.textContent = task.title;
                var tdResource = document.createElement('td');
                tdResource.textContent = task.assignee ? task.assignee.name : '';
                tr.appendChild(tdTask);
                tr.appendChild(tdResource);
                tableBody.appendChild(tr);
            });
        }
    }

function renderChart(tasks) {
    var ctx = document.getElementById('ganttChart').getContext('2d');

    if (window.ganttChartInstance) {
        window.ganttChartInstance.destroy();
    }

    var validTasks = tasks.filter(t => t.project && t.project.start_date && t.due_date);

    if (validTasks.length === 0) {
        console.warn("No valid tasks found");
        return;
    }

    const parseDate = d => new Date(d);
    const allDates = validTasks.flatMap(t => [parseDate(t.project.start_date), parseDate(t.due_date)]);
    const minDate = new Date(Math.min(...allDates));
    const maxDate = new Date(Math.max(...allDates));

    // ✅ Calculate duration in days
    const diffInDays = Math.ceil((maxDate - minDate) / (1000 * 60 * 60 * 24));

    // ✅ Choose label format based on duration
    const isShortDuration = diffInDays < 30;
    const dayNames = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];

    const data = {
        labels: validTasks.map(t => t.title),
        datasets: [{
            label: 'Tasks Timeline',
            data: validTasks.map(t => [parseDate(t.project.start_date), parseDate(t.due_date)]),
            backgroundColor: '#0C5097',
            borderRadius: 6,
            barPercentage: 0.7
        }]
    };

    const options = {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: {
                type: 'time',
                position: 'top',
                min: minDate,
                max: maxDate,
                time: {
                    unit: 'day',
                    displayFormats: isShortDuration
                        ? { day: 'E' }
                        : { day: 'MMM d, yyyy' },
                    tooltipFormat: 'MMM d, yyyy'
                },
                title: {
                    display: true,
                    text: isShortDuration ? 'Days of Week' : 'Timeline',
                    color: '#0C5097',
                    font: { size: 14, weight: 'bold' }
                },
                grid: { color: '#e0e0e0' },
                ticks: {
                    color: '#222',
                    autoSkip: true,
                    font: { size: 12 },
                    // ✅ Custom tick label: e.g. "W (23 Oct 2025)"
                    callback: function(value) {
                        const date = new Date(value);
                        if (isShortDuration) {
                            const dayName = dayNames[date.getDay()];
                            const formattedDate = date.toLocaleDateString('en-US', {
                                day: 'numeric',
                                month: 'short',
                                year: 'numeric'
                            });
                            return `${dayName} (${formattedDate})`;
                        } else {
                            return date.toLocaleDateString(undefined, { month: 'short', day: 'numeric', year: 'numeric' });
                        }
                    }
                }
            },
            y: {
                grid: { display: false },
                ticks: {
                    color: '#000',
                    font: { size: 12 },
                    callback: (value, index) => validTasks[index] ? validTasks[index].title : ''
                }
            }
        },
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: function (ctx) {
                        const start = ctx.raw[0] ? new Date(ctx.raw[0]).toLocaleDateString() : '';
                        const end = ctx.raw[1] ? new Date(ctx.raw[1]).toLocaleDateString() : '';
                        const task = validTasks[ctx.dataIndex];
                        return `${task.title} (${task.assignee?.name || ''}): ${start} → ${end}`;
                    }
                }
            }
        }
    };

    window.ganttChartInstance = new Chart(ctx, {
        type: 'bar',
        data,
        options
    });
}


    function updateGantt() {
        var filtered = getFilteredTasks();
        renderTable(filtered);
        renderChart(filtered);
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('filter-search')?.addEventListener('click', updateGantt);
        document.getElementById('projectFilter')?.addEventListener('change', updateGantt); // ✅ Added project filter listener
        updateGantt();
    });
</script>




    function updateGantt() {
        var filtered = getFilteredTasks();
        renderTable(filtered);
        renderChart(filtered);
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('filter-search').addEventListener('click', updateGantt);
        updateGantt();
    });
    
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const projectButtons = document.querySelectorAll('.btn-project');
    const editButton = document.getElementById('editMainButton');
    const projectFilter = document.getElementById('projectFilter');

    // 🔹 Dropdown change par active button highlight karna
    projectFilter.addEventListener('change', function () {
        const selectedId = this.value;
        projectButtons.forEach(btn => {
            const project = JSON.parse(btn.getAttribute('data-project'));
            if (project.id.toString() === selectedId) {
                btn.classList.add('active-project');
            } else {
                btn.classList.remove('active-project');
            }
        });
    });

    // 🔹 Button click par dropdown aur edit data dono update karna
    projectButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Remove active class from all project buttons
            projectButtons.forEach(btn => btn.classList.remove('active-project'));

            // Add active class to clicked one
            this.classList.add('active-project');

            // Get project data
            const project = JSON.parse(this.getAttribute('data-project'));

            // Set data on edit button
            editButton.setAttribute('data-project', JSON.stringify(project));
            editButton.textContent = `Edit: ${project.name}`;

            // ✅ Dropdown select update
            projectFilter.value = project.id?.toString();

            // ✅ Trigger dropdown change event (to run same logic)
            projectFilter.dispatchEvent(new Event('change'));
        });
    });

    // 🔹 Edit button modal open par data set karna
    editButton.addEventListener('click', function () {
        const project = JSON.parse(this.getAttribute('data-project') || '{}');
        if (project.id) {
            document.getElementById('editProjectId').value = project.id;
            document.getElementById('editProjectName').value = project.name;
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Listen for button click
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('open-task-modal')) {
            const taskId = e.target.getAttribute('data-task-id');
            const taskName = e.target.getAttribute('data-task-name');

            // Fill modal data
            document.getElementById('modalTaskId').textContent = taskId;
            document.getElementById('modalTaskName').textContent = taskName;
        }
    });
});
</script>




@endpush

<style>
     .container {
      display: flex;
      width: 100%;
      height: 600px;
    }
    .task-table {
      width: 30%;
      border-collapse: collapse;
      margin-right: 10px;
    }
    .task-table th, .task-table td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    .task-table th {
      background-color: #f4f4f4;
    }
    .chart-container {
      width: 70%;
    }
        .gantt-table-wrapper {
            height: 500px;
            max-height: 500px;
            overflow-y: auto;
            border-right: 1px solid #e0e0e0;
            background: #f8fafc;
            padding-right: 0;
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        }
        .gantt-table {
            width: 100%;
            background: #fff;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 15px;
        }
        .gantt-table-header th {
            position: sticky;
            top: 0;
            background: #f8fafc;
            font-weight: bold;
            color: #222;
            border-bottom: 2px solid #e0e0e0;
            z-index: 3;
            padding: 10px 8px;
            font-size: 16px;
            letter-spacing: 0.5px;
        }
        .gantt-th {
            border-right: 1px solid #e0e0e0;
            text-align: left;
        }
        .gantt-td {
            padding: 8px 8px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 15px;
            color: #333;
            background: #fff;
            vertical-align: middle;
        }
        .gantt-table tr:last-child .gantt-td {
            border-bottom: none;
        }
        .gantt-chart-wrapper {
            height: 500px;
            max-height: 500px;
            overflow-x: auto;
            background: #fff;
            border-left: 1px solid #e0e0e0;
            padding-left: 0;
        }
        #gantt-chart {
            width: 100%;
            height: 500px;
            min-height: 500px;
            background: #fff;
        }
    .nav-tabs {
        border-bottom: none;
        gap: 20px;
    }

    .nav-tabs .nav-link {
        border: none;
        background: transparent;
        font-size: 12px;
        color: #0C5097;
        transition: all 0.3s ease;
    }content

    .nav-tabs .nav-link.active {
        font-size: 15px;
        font-weight: 600;
        border-radius: 0px;
        color: #6D5684 !important;
        background-color: #0C5097;
    }

    #statusHistoryModal .modal-content {
        transition: transform 0.3s ease-in-out;
        border: none;
    }

    #statusHistoryModal.show .modal-content {
        transform: scale(1);
    }

    #statusHistoryModal .modal-body {
        max-height: 80vh;
        overflow-y: auto;
        background: #ffffff;
    }

    #statusHistoryModal .nav-tabs .nav-link {
        color: #6b7280;
        border: none;
        border-bottom: 2px solid transparent;
        transition: all 0.3s ease;
        font-weight: 500;
        background-color: transparent;
        /* Ensure no white bg */
    }

    #statusHistoryModal .nav-tabs .nav-link.active,
    #statusHistoryModal .nav-tabs .nav-link:hover {
        color: #0C5097;
        /* Dark blue for visibility */
        border-bottom: 2px solid #0C5097;
        background-color: transparent;
        /* Prevent white bg */
    }

    #statusHistoryModal .table-hover tbody tr:hover {
        background-color: #f9fafb;
    }

    #statusHistoryModal .badge {
        font-weight: 500;
        border-radius: 16px;
        transition: all 0.3s ease;
    }

    #statusHistoryModal .badge.projectStatus {
        background-color: #10b981;
        color: white;
        padding: 0.375rem 0.75rem;
        font-size: 0.8125rem;
    }

    #statusHistoryModal .badge.priority {
        background-color: #f59e0b;
        color: white;
        padding: 0.375rem 0.75rem;
        font-size: 0.8125rem;
    }

    #statusHistoryModal .badge.bg-warning {
        background-color: #f59e0b !important;
    }

    #statusHistoryModal .project-details {
        text-align: center;
        /* Center align all content */
    }

    #statusHistoryModal .project-details label {
        font-size: 0.8125rem;
        color: #6b7280;
        margin-bottom: 0.5rem;
        font-weight: 500;
        display: flex;
        align-items: center;
      
    }

    #statusHistoryModal .project-details .fw-medium {
        color: #1f293content7;
        word-break: break-word;
        font-size: 0.9375rem;
        margin-bottom: 0.25rem;
        /* Consistent spacing below values */
    }

    #statusHistoryModal .comments-container,
    #statusHistoryModal #statusHistory {
        max-height: 250px;
        overflow-y: auto;
    }

    #statusHistoryModal .comment-input .input-group {
        width: 100%;
    }

    #statusHistoryModal .tab-content {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    #statusHistoryModal .tab-pane {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    #statusHistoryModal .btn-primary:hover {
        background: #1A73E8;
    }

    #statusHistoryModal .card {
        border-radius: 8px;
        background: #f9fafb;
    }

    #statusHistoryModal .text-sm {
        font-size: 0.8125rem;
    }

    #statusHistoryModal .space-y-4>*+* {
        margin-top: 1rem;
    }

    #statusHistoryModal .bg-gray-50 {
        background-color: #f9fafb;
    }

    .modal-lg {
        max-width: 900px;
    }

    .modal-body {
        padding: 0;
    }

    .modal-header,
    .modal-footer {
        padding: 1.5rem;
    }

    label {
        margin-bottom: 0.25rem;
        font-weight: 500;
    }

    textarea.form-control {
        resize: vertical;
    }

    .task-row+.task-row {
        margin-top: 0.25rem;
    }

    #statusHistoryModal .tab-pane.fade:not(.show) {
        display: none !important;
        height: 0 !important;
        overflow: hidden !important;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        #statusHistoryModal .modal-dialog {
            max-width: 90%;
        }

        #statusHistoryModal .modal-body .d-flex {
            flex-direction: column;
        }

        #statusHistoryModal .col-md-4,
        #statusHistoryModal .col-md-8 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        #statusHistoryModal .bg-gray-50 {
            border-right: none;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 1.5rem;
        }

        #statusHistoryModal .comments-container,
        #statusHistoryModal #statusHistory {
            max-height: 200px;
        }

        #statusHistoryModal .card.mb-4 {
            margin-bottom: 1rem !important;
        }

        #statusHistoryModal .nav-tabs .nav-link {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
    }

    @media (min-width: 769px) and (max-width: 991px) {
        #statusHistoryModal .col-md-4 {
            flex: 0 0 35%;
            max-width: 35%;
        }

        #statusHistoryModal .col-md-8 {
            flex: 0 0 65%;
            max-width: 65%;
        }

        #statusHistoryModal .comments-container,
        #statusHistoryModal #statusHistory {
            max-height: 220px;
        }
    }
</style>
 