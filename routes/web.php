<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\ProjectController;
use App\Http\Controllers\Web\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');

Route::post('login', [AuthController::class, 'processLogin'])->name('login.post');
Route::post('register', [AuthController::class, 'processRegister'])->name('register.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');;

Route::middleware(['auth'])->group(function () {

    Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::get('projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
    Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::get('tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::get('/', function () {
        return redirect()->route('tasks.index');
    });
});
