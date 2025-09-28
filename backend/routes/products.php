<?php

use App\Http\Controllers\Product\MovementController;
use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('/{uuid}/movement', [MovementController::class, 'store']);

Route::controller(ProductController::class)->group(function () {
    Route::post('', 'store');
    Route::get('', 'index');
    Route::get('{uuid}', 'show');
    Route::put('{uuid}', 'update');
});
