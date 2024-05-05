<?php
namespace App\DTOs;

class FeedbackDTO{
    private $postId;
    public function __construct(int $postId)
    {
        $this->postId = $postId;
    }

    public function getPostId()
    {
        return $this->postId;
    }
}
