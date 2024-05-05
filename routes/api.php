<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/signup', \App\Http\Controllers\Auth\SignupController::class);
Route::post('/signin', \App\Http\Controllers\Auth\SigninController::class);