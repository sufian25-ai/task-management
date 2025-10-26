<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController; // নতুন
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Projects (সব users access করতে পারবে)
    Route::resource('projects', ProjectController::class);

    // Tasks (সব users access করতে পারবে)
    Route::resource('tasks', TaskController::class);
    
    // AJAX route for task status update
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])
        ->name('tasks.update-status');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ========== ADMIN ONLY ROUTES ==========
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    
    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
    
    // View all users
    Route::get('/admin/users', [AdminController::class, 'users'])
        ->name('admin.users');
    
    // View all projects (সব users এর)
    Route::get('/admin/projects', [AdminController::class, 'projects'])
        ->name('admin.projects');
    
    // View all tasks (সব users এর)
    Route::get('/admin/tasks', [AdminController::class, 'tasks'])
        ->name('admin.tasks');
    
    // Delete any project (force delete)
    Route::delete('/admin/projects/{project}', [AdminController::class, 'deleteProject'])
        ->name('admin.projects.delete');
    
    // Change user role
    Route::patch('/admin/users/{user}/role', [AdminController::class, 'changeRole'])
        ->name('admin.users.change-role');
});

require __DIR__.'/auth.php';