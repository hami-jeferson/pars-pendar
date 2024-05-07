<?php

namespace App\Listeners;

use App\Contracts\UserRepositoryInterface;
use App\Events\NewPost;
use App\Mail\PostCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailNotif implements ShouldQueue
{
    use InteractsWithQueue;
    protected $maxAttempts = 3;
    protected $post;
    private $UserRepository;
    /**
     * Create the event listener.
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->UserRepository = $userRepository;
    }

    /**
     * Handle the event.
     */
    public function handle(NewPost $event): void
    {
        $this->post = $event->post;
        $admin = $this->UserRepository->adminUser();
        //Log::channel('info')->info('email triggered');

        $attempts = 0;
        $success = false;
        $notification = new PostCreatedMail($this->post);

        while ($attempts < $this->maxAttempts && !$success) {
            try {
                Mail::to($admin->email)->send($notification);
                $success = true;
            } catch (\Exception $e) {
                // Log the error
                \Log::error('Email sending failed: ' . $e->getMessage());
                // Increment attempts
                $attempts++;
                // Delay between retries
                sleep(10); // Adjust the delay as needed
            }
        }

        if (!$success) {
            // Send a notification to admin about email sending failure
            // This could be an email, a log entry, etc.
            \Log::error('Email sending failed after ' . $this->maxAttempts . ' attempts.');
        }

    }
}
