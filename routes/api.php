<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::prefix('users')->controller(UserController::class)->group(function () {
//   Route::get('', 'getAll');
//   Route::get('/{id}', 'getById');
//   Route::post('', 'store');
//   Route::put('/{id}', 'update');
//   Route::delete('/{id}', 'destroy');
// });

Route::prefix('todos')->middleware(['auth:sanctum'])->controller(TodoController::class)->group(function () {
    Route::get('', 'index');
    Route::get('/{id}', 'show');
    Route::post('', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
    Route::post('/{id}/make-done', 'makeTodoDone');
});

Route::prefix("/auth")->controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::middleware(['auth:sanctum'])->post('/logout', 'logout');
    //get auth user
    Route::middleware(['auth:sanctum'])->get("/user", 'getAuthUser');
});
