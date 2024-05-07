<?php

namespace App\Observers;

use App\Events\NewPost;
use App\Jobs\NewPostJob;
use App\Models\PostModel;

class PostObserver
{
    /**
     * Handle the PostModel "created" event.
     */
    public function created(PostModel $postModel): void
    {
        NewPostJob::dispatch($postModel);
    }

    /**
     * Handle the PostModel "updated" event.
     */
    public function updated(PostModel $postModel): void
    {
        //
    }

    /**
     * Handle the PostModel "deleted" event.
     */
    public function deleted(PostModel $postModel): void
    {
        //
    }

    /**
     * Handle the PostModel "restored" event.
     */
    public function restored(PostModel $postModel): void
    {
        //
    }

    /**
     * Handle the PostModel "force deleted" event.
     */
    public function forceDeleted(PostModel $postModel): void
    {
        //
    }
}
