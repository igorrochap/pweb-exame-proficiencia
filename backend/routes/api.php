<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Product\CategoryController;
use App\Http\Middleware\ApiAuthentication;
use Illuminate\Support\Facades\Route;

Route::post('/users', [UserController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(ApiAuthentication::class)->group(function () {
    Route::get('categories', [CategoryController::class, 'index']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::prefix('auth')->controller(AuthController::class)->group(function () {
        Route::get('/me', 'user');
    });
});
