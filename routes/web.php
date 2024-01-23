<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CommonAreaController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


//profile routes-------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------
// Route::post('users/{user}/update-personal', [UserController::class, 'updatePersonal'])->middleware('auth')->name('users.profile.update-personal');
Route::get('users-get-notifications', [UserController::class, 'getNotifications'])->name('users.get-notifications')->middleware('auth');
Route::delete('users-delete-notifications', [UserController::class, 'deleteNotifications'])->name('users.delete-user-notifications')->middleware('auth');
Route::post('users-read-notifications', [UserController::class, 'readNotifications'])->name('users.read-user-notifications')->middleware('auth');


// --------------- Calendar routes -----------------
Route::resource('calendars', CalendarController::class)->middleware('auth');
Route::put('calendars-{calendar}-task-done', [CalendarController::class, 'taskDone'])->name('calendars.task-done')->middleware('auth');
Route::put('calendars/set-attendance-confirmation/{calendar}', [CalendarController::class, 'SetAttendanceConfirmation'])->name('calendars.set-attendance-confirmation');


// --------------- common areas routes -----------------
Route::resource('common-areas', CommonAreaController::class)->middleware('auth');
