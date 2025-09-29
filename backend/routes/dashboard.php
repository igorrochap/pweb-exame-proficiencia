<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::controller(DashboardController::class)->group(function () {
    Route::get('/total', 'totalValueInStock');
    Route::get('/top-categories', 'topCategories');
    Route::get('/last-movements', 'lastMovements');
});
