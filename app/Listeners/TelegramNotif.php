<?php

namespace App\Listeners;

use App\Events\NewPost;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class TelegramNotif
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewPost $event): void
    {
        Log::channel('info')->info('Telegram triggered');
        // TODO add logic
    }
}
