<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

# Auth controller
Route::post('/signup', \App\Http\Controllers\Api\Auth\SignupController::class);
Route::post('/signin', \App\Http\Controllers\Api\Auth\SigninController::class);

# Post controller
Route::apiResource('post', \App\Http\Controllers\Api\PostController::class)->middleware(['auth:sanctum', 'can_crud_post'])->except(['index', 'show']);
Route::apiResource('post', \App\Http\Controllers\Api\PostController::class)->only(['index', 'show']);

# Comment controller
Route::apiResource('post/{post}/comment',\App\Http\Controllers\Api\CommentController::class)->middleware('auth:sanctum')->except(['update', 'destroy', 'index']);
Route::apiResource('post/{post}/comment',\App\Http\Controllers\Api\CommentController::class)->only(['index']);
Route::group(['middleware'=>['auth:sanctum', 'can_edit_comment'], 'prefix'=>'/comment'], function(){
    Route::put('/{comment}', [\App\Http\Controllers\Api\CommentController::class, 'update']);
    Route::delete('/{comment}', [\App\Http\Controllers\Api\CommentController::class, 'destroy']);
});

# Feedback controller
Route::apiResource('post/{post}/feedback',\App\Http\Controllers\Api\FeedbackController::class)->middleware('auth:sanctum')->except(['update', 'destroy', 'index']);
Route::apiResource('post/{post}/feedback',\App\Http\Controllers\Api\FeedbackController::class)->only(['index']);
Route::group(['middleware'=>['auth:sanctum', 'can_edit_feedback'], 'prefix'=>'/feedback'], function(){
    Route::put('/{feedback}', [\App\Http\Controllers\Api\FeedbackController::class, 'update']);
    Route::delete('/{feedback}', [\App\Http\Controllers\Api\FeedbackController::class, 'destroy']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

