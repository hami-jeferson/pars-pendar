<?php

namespace App\Providers;

use App\Models\CommentModel;
use App\Models\PostModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use App\Traits\Response;
class RouteBindingProvider extends ServiceProvider
{
    use Response;
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::model('comment', CommentModel::class, function ($value) {
            abort(response()->json(['success' =>false, 'message'=> 'Comment not found'], 404));
        });

        Route::model('post', PostModel::class, function ($value) {
            abort(response()->json(['success' =>false, 'message'=> 'Post not found'], 404));
        });
    }
}
