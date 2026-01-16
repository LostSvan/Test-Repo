<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::post('login', [AuthController::class, 'login'])->name('api.login');
Route::post('register', [AuthController::class, 'register'])->name('api.register');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('api.logout');

    Route::get('projects', [ProjectController::class, 'index'])->name('api.projects.index');
    Route::post('projects/store', [ProjectController::class, 'store'])->name('api.projects.store');
    Route::put('projects/{project}', [ProjectController::class, 'update'])->name('api.projects.update');
    Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('api.projects.destroy');

    Route::get('tasks', [TaskController::class, 'index'])->name('api.tasks.index');
    Route::get('tasks/{task}', [TaskController::class, 'show'])->name('api.tasks.show');
    Route::post('tasks/store', [TaskController::class, 'store'])->name('api.tasks.store');
    Route::put('tasks/{task}', [TaskController::class, 'update'])->name('api.tasks.update');
    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('api.tasks.destroy');

});
