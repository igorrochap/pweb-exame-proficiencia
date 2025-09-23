<?php


use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post("/users", [UserController::class, "store"]);
Route::get("/users", fn() => \App\Models\User::all());
