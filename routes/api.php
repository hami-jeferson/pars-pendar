<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

# Auth controller
Route::post('/signup', \App\Http\Controllers\Api\Auth\SignupController::class);
Route::post('/signin', \App\Http\Controllers\Api\Auth\SigninController::class);

# Post controller
Route::apiResource('post', \App\Http\Controllers\Api\PostController::class)->middleware('auth:sanctum')->except(['index', 'show']);
Route::apiResource('post', \App\Http\Controllers\Api\PostController::class)->only(['index', 'show']);

# Comment controller
Route::apiResource('post/{slug}/comment',\App\Http\Controllers\Api\CommentController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

