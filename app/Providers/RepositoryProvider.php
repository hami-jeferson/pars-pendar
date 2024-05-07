<?php

namespace App\Providers;

use App\Contracts\AuthRepositoryInterface;
use App\Contracts\CommentRepositoryInterface;
use App\Contracts\FeedbackRepositoryInterface;
use App\Contracts\ImageRepositoryInterface;
use App\Contracts\PostRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Repositories\AuthRepository;
use App\Repositories\CommentRepository;
use App\Repositories\FeedbackRepository;
use App\Repositories\ImageRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(FeedbackRepositoryInterface::class, FeedbackRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
