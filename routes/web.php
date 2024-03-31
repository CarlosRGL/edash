<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect(
    '/',
    '/dashboard',
);


Route::middleware(['auth', 'verified'])->group(
    function () {
        Route::get(
            '/dashboard',
            function () {
                return Inertia::render('Dashboard');
            }
        )->name('dashboard');

        Route::resource('user', UserController::class); // User
        Route::resource('project', ProjectController::class); // User
        Route::resource('task', TaskController::class); // User
    }
);

Route::middleware('auth')->group(
    function () {
        Route::get('/profile', array( ProfileController::class, 'edit' ))->name('profile.edit');
        Route::patch('/profile', array( ProfileController::class, 'update' ))->name('profile.update');
        Route::delete('/profile', array( ProfileController::class, 'destroy' ))->name('profile.destroy');
    }
);

require __DIR__ . '/auth.php';
