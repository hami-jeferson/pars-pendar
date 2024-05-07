<?php

namespace App\Jobs;

use App\Events\NewPost;
use App\Models\PostModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NewPostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $post;
    /**
     * Create a new job instance.
     */
    public function __construct(PostModel $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::channel('info')->info('job runed');
        event(new NewPost($this->post));
    }
}
