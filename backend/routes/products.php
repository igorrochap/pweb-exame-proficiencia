<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(ProductController::class)->group(function () {
    Route::post('', 'store');
    Route::get('', 'index');
    Route::get('{uuid}', 'show');
    Route::put('{uuid}', 'update');
});
