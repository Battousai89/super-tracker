<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TracksController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('login', [AuthController::class, 'login'])->name('login')->withoutMiddleware('auth:sanctum');
            Route::get('check', [AuthController::class, 'check'])->name('check');
            Route::get('logout', [AuthController::class, 'logout'])->name('logout');
            Route::post('register', [AuthController::class, 'register'])->name('register')->withoutMiddleware('auth:sanctum');
        });

        Route::prefix('tasks')->group(function () {
            Route::middleware('auth:sanctum')->get('', [TasksController::class, 'getTasks'])->name('tasks');
            Route::post('', [TasksController::class, 'addTask'])->name('task_add');
            Route::get('{id}', [TasksController::class, 'getTask'])->name('task');
            Route::get('{id}/tracks', [TasksController::class, 'getTaskTracks'])->name('task_tracks');
            Route::put('{id}', [TasksController::class, 'saveTask'])->name('task_save');
        });

        Route::prefix('users')->group(function () {
            Route::get('', [UsersController::class, 'getUsers'])->name('users');
        });

        Route::prefix('tracks')->group(function () {
            Route::post('', [TracksController::class, 'addTrack'])->name('track_add');
        });

        Route::prefix('statistics')->group(function () {
            Route::get('', [StatisticsController::class, 'getStatistics'])->name('statistics');
        });

        Route::prefix('projects')->group(function () {
            Route::get('', [ProjectsController::class, 'getProjects'])->name('projects');
            Route::post('', [ProjectsController::class, 'addProject'])->name('project_add');
            Route::get('{id}', [ProjectsController::class, 'getProject'])->name('project');
            Route::put('{id}', [ProjectsController::class, 'saveProject'])->name('project_save');
        });
    });
});

