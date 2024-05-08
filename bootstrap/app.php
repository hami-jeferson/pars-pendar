<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'can_edit_comment'=> \App\Http\Middleware\CanEditComment::class,
            'can_edit_feedback'=> \App\Http\Middleware\CanEditFeedback::class,
            'can_crud_post'=> \App\Http\Middleware\CanCRUDPost::class,
            'auth.token'=> \App\Http\Middleware\AuthenticateToken::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
