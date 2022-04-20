<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/tasks/{search}', [TaskController::class, 'search']);
Route::get('/task/{id}', [TaskController::class, 'show']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/task', [TaskController::class, 'store']);
    Route::delete('/task/{id}', [TaskController::class, 'destroy']);
    Route::post('/task/{id}', [TaskController::class, 'update']);
    Route::get('/complete/{id}', [TaskController::class, 'completeTask']);
});
