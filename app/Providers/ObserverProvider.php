<?php

namespace App\Providers;

use App\Models\PostModel;
use App\Observers\PostObserver;
use Illuminate\Support\ServiceProvider;

class ObserverProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        PostModel::observe(PostObserver::class);
    }
}
