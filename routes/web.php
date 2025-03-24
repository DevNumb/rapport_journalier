<?php
// routes/web.php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\JournalierController;
use App\Http\Controllers\ActivityLogController;

// routes/web.php



// Redirect the root URL to the login page
Route::get('/', function () {
    return redirect()->route('login');
});




Route::post('/login', [LoginController::class, 'authenticate'])->name('login.submit');

Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout')->middleware('auth');

// Dashboard Route
Route::get('/dashboard', [WorkerController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Other Routes
Route::get('/calendar', [EventController::class, 'index'])->name('calendar.index');
Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
Route::resource('events', EventController::class)->middleware('auth');

Route::resource('workers', WorkerController::class)->middleware('auth');
Route::resource('activities', ActivityController::class)->middleware('auth');
Route::resource('tasks', TaskController::class)->middleware('auth');
Route::resource('projects', ProjectController::class)->middleware('auth');
Route::resource('journaliers', JournalierController::class)->middleware('auth');
Route::resource('reports', ReportController::class)->middleware('auth');
Route::resource('activity-logs', ActivityLogController::class)->only(['index'])->middleware('auth');

Route::get('/export', [ActivityController::class, 'export'])->name('activities.export')->middleware('auth');
Route::get('/exportTask', [TaskController::class, 'export'])->name('tasks.export')->middleware('auth');
Route::get('/exportReport', [ReportController::class, 'export'])->name('reports.export')->middleware('auth');
Route::get('/exportProject', [ProjectController::class, 'export'])->name('projects.export')->middleware('auth');
Route::get('/exportJournalier', [JournalierController::class, 'export'])->name('journaliers.export')->middleware('auth');
Route::get('/projects/{id}/statistics', [ProjectController::class, 'getStatistics'])->name('projects.statistics');



// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// routes/web.php

// routes/web.php

Route::get('/workers/{worker_id}/tasks', [WorkerController::class, 'getTasksByWorker']);


Route::get('/projects/{project}/statistics', [ProjectController::class, 'getStatistics'])->name('projects.statistics');
Route::get('/projects/{project}/user-statistics', [ProjectController::class, 'getUserStatistics'])->name('projects.userStatistics');
// routes/web.php

Route::get('/worker/stats/{worker_id}/{statsType?}', [WorkerController::class, 'getWorkerStats'])->name('worker.stats');

// routes/web.php
// routes/web.php
// routes/web.php

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // Admin-specific routes
    });

    Route::group(['middleware' => ['worker']], function () {
        Route::get('/worker/tasks', function () {
            return view('worker.tasks');
        })->name('worker.tasks');

        Route::get('/worker/calendar', function () {
            return view('worker.calendar');
        })->name('worker.calendar');
    });

    // Shared routes for both roles
    Route::get('/dashboard', [WorkerController::class, 'index'])->name('dashboard');
});

Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');


require __DIR__.'/auth.php';
