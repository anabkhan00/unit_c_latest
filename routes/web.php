<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\FileSyncController;
use App\Http\Controllers\MinisiteController;
use App\Http\Controllers\NewsFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TasksDocumentController;
use App\Http\Controllers\SubTaskController;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Auth Controller Routes with redirect(guest) middleware
Route::middleware('guest')->group(function () {
    Route::redirect('/login', '/');
    Route::view('/', 'auth.login')->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'index'])->name('register.index');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    Route::view('/forgot-password', 'auth.forgot-password')->name('forgot-password');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');
});

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login.form');
})->middleware('auth')->name('logout');

//Socialite Login
Route::prefix('auth')->controller(SocialiteController::class)->group(function () {
    //Redirect to provider
    Route::get('{provider}', 'redirectToProvider')
        ->where('provider', 'google|slack')
        ->name('auth.provider');

    //Callback from provider
    Route::get('{provider}-callback', 'handleProviderCallback')
        ->where('provider', 'google|slack')
        ->name('auth.provider-callback');
});

//Authenticated Routes
Route::middleware(['auth'])->group(function () {
    //Dashboard
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/users', 'getUsers');
        Route::get('/teams', 'getTeams');
        Route::post('/share-file', 'shareFile');
        Route::post('/media/store', 'store')->name('media.store');
        Route::delete('/media/{id}', 'destroy')->name('media.destroy');
        Route::post('/dashboard/events/store', 'event_store')->name('dashboard.events.store');
        Route::get('full-calendar', 'fullCalendar')->name('full-calendar');
        Route::get('/calendar/events', 'getEvents');
        Route::delete('/event/{id}', 'deleteEvent')->name('event.delete');
        Route::get('/emails/filter', 'emailFilter')->name('emails.filter');
        Route::post('/emails/star-toggle/{id}', 'toggleStar');
        //test mail notificaiton
        Route::get('/send-test-mail', 'sendTestMail');
    });

    //Email
    Route::get('/email/{type}', [EmailController::class, 'index'])->name('email.index');
    Route::post('/email', [EmailController::class, 'store'])->name('email.store');
    Route::get('/check-email', function (Request $request) {
        $email = $request->query('email');
        $exists = \App\Models\User::where('email', $email)->exists();
        return response()->json(['exists' => $exists]);
    });

    Route::prefix('emails')->name('email.')->controller(EmailController::class)->group(function () {
        Route::post('/star/{id}', 'toggleStar')->name('star');
        Route::post('/delete/{id}', 'deleteEmail')->name('delete');
        Route::post('/mark-read/{id}', 'markAsRead')->name('markRead');
        Route::post('/toggle-draft', 'toggleDraft')->name('toggleDraft');
        Route::post('/{email}/move', 'moveEmail')->name('move');
        Route::get('/folder/{id}', 'getFolderEmails')->name('folder');
        Route::get('/{id}', 'getEmailDetails')->name('details');
    });
    Route::delete('/folders/{id}', [EmailController::class, 'destroy'])->name('folders.destroy');

    //Project
    
// Upload document
    Route::post('/tasks/documents', [TasksDocumentController::class, 'store'])->name('tasks-documents.store');
    Route::get('/tasks/{taskId}/documents', [TasksDocumentController::class, 'getDocuments'])
     ->name('tasks.documents');


Route::post('/sub-tasks', [SubTaskController::class, 'store'])->name('subtasks.store');

    // Delete document
    Route::delete('/tasks/documents/{docId}', [TasksDocumentController::class, 'destroy'])->name('tasks-documents.destroy');

    Route::resource('project', ProjectController::class);
    Route::put('/projects_main/{id}', [ProjectController::class, 'update_main'])->name('project.main.update');
    Route::get('/projects/graph', [ProjectController::class, 'graph'])->name('project.graph');
    Route::get('/tasks', [TaskController::class, 'fetchTasks'])->name('fetch.tasks');
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('task.show');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('task.edit');
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('task.update.status');
    Route::post('/tasks', [TaskController::class, 'store'])->name('task.store');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('task.destroy');
    Route::post('/tasks/{task}/comments', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/projects/{id}', [ProjectController::class, 'getProjectDetails']);
    Route::post('/update-task-status', [ProjectController::class, 'updateStatus'])->name('update.task.status');
    Route::get('/get/users', [ProjectController::class, 'getUsers'])->name('get.users');
    Route::get('/get-project-files/{projectId}', function ($taskId) {
        $files = \App\Models\Project::where('id', $taskId)->get();
        return response()->json(['files' => $files]);
    });
    Route::get('/fetch', [ProjectController::class, 'fetchProjects'])->name('fetch.projects');

    //Notes
    Route::resource('note', NoteController::class);
    Route::get('/filter-notes', [NoteController::class, 'filterNotes']);

    //Teams
    Route::resource('team', TeamController::class);

    //News Feed
    Route::resource('news-feed', NewsFeedController::class);
    Route::get('/search-news', [NewsFeedController::class, 'searchNews']);

    //File Sync
    Route::resource('file-sync', FileSyncController::class);
    Route::post('/files/rename/{file}', [FileSyncController::class, 'rename'])->name('files.rename');
    Route::post('/filter', [FileSyncController::class, 'filter'])->name('files.filter');
    Route::get('download-folder/{folderPath}', [FileSyncController::class, 'downloadFolder'])->where('folderPath', '.*');
    Route::get('/get-folder-content/{folderPath}', [FileSyncController::class, 'getFolderContent'])->where('folderPath', '.*');
    Route::delete('/file-sync/delete', [FileSyncController::class, 'destroy']);
    Route::get('/file-sync/download/{id}', [FileSyncController::class, 'downloadFile'])->name('file-sync.download');
    Route::get('/file-syncs/all', [FileSyncController::class, 'all'])->name('file-syncs.all');

    //Minisite
    Route::controller(MinisiteController::class)->group(function () {
        Route::get('/minisites',  'index')->name('minisites.index');
        Route::post('/minisites/storePage',  'storePage')->name('minisites.storePage');
        Route::post('/minisites/storeDocument',  'storeDocument')->name('minisites.storeDocument');
        Route::get('/get-minisite-records/{teamId}',  'getMinisiteRecords');
        Route::get('/get-page-records/{id}',  'getPageRecords');
        Route::get('/get-page-record/{id}',  'edit');
        Route::post('/update-page/{id}',  'update');
        Route::delete('/delete-page/{id}',  'destroy');
    });

    //chat
    Route::get('/chat', [ChatController::class, 'index_list'])->name('chat.index_list');
    Route::get('/chat/{receiver_id}', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');

    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
    Route::post('/chat/upload', [ChatController::class, 'upload'])->name('chat.upload');


    Route::get('/group-chat', [ChatController::class, 'teamList'])->name('group.chat.list');
    Route::get('/group-chat/{team_id}', [ChatController::class, 'teamChat'])->name('group.chat.view');
    Route::post('/group-chat/send', [ChatController::class, 'sendGroupMessage'])->name('group.chat.send');
    Route::post('/chat/send-group-file', [ChatController::class, 'sendGroupFile'])->name('group.chat.send.file');



    //Folder
    Route::get('/folders', [FolderController::class, 'index'])->name('folders.index');
    Route::post('/folders', [FolderController::class, 'store'])->name('folders.store');

    //Calendar
    Route::prefix('events')->name('events.')->controller(CalendarController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'storeOrUpdate')->name('store');
        Route::match(['put', 'patch'], '/{id}', 'storeOrUpdate')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
        Route::post('/{id}/send-notifications', 'sendNotifications')->name('sendNotifications');
    });

    //Zoom Meeting
    Route::get('zoom/authorize', [MeetingController::class, 'authorizeZoom'])->name('zoom.authorize');
    Route::get('/zoom-meeting-create', [MeetingController::class, 'handleCallback'])->name('zoom.callback');
    Route::get('/meetings', [MeetingController::class, 'index'])->name('meetings.index');
    Route::get('zoom/meetings/create', [MeetingController::class, 'showCreateForm'])->name('zoom.meetings.create');
    Route::post('zoom/meetings/store', [MeetingController::class, 'store'])->name('zoom.meetings.store');
    Route::get('/meetings/{id}/edit', [MeetingController::class, 'edit'])->name('meetings.edit');
    Route::post('/meetings/{id}/update', [MeetingController::class, 'update'])->name('meetings.update');


    // Google Meet Routes
    Route::get('google/authorize', [MeetingController::class, 'authorizeGoogle'])->name('google.authorize');
    Route::get('/google-meet-callback', [MeetingController::class, 'handleCallback'])->name('google.callback');
    Route::resource('meetings', MeetingController::class)->except(['show', 'create']);
    Route::get('/meetings', [MeetingController::class, 'index'])->name('meetings.index');

    //Video Meeting
    Route::get('video/authorize', [VideoController::class, 'authorizeZoom'])->name('video.authorize');
    Route::get('public/video-meeting-create', [VideoController::class, 'handleCallback'])->name('video.callback');
    Route::get('/public/video/create-meeting', [VideoController::class, 'createMeeting'])->name('video.create');
});

Route::get('clear-cache', function () {
    Artisan::call('optimize:clear');
    return response()->json([
        'message' => 'Application cache cleared successfully!'
    ]);
});

Route::fallback(function () {
    return response()->json([
        'message' => 'Route not found. Please check the URL and try again'
    ], 404);
});
