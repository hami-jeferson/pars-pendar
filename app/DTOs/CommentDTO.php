<?php
namespace App\DTOs;

class CommentDTO{
    private $rate;
    private $comment;
    private $postId;
    public function __construct(int $rate, string $comment = null, int $postId)
    {
        $this->rate = $rate;
        $this->comment = $comment;
        $this->postId = $postId;
    }

    public function getRate()
    {
        return $this->rate;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getPostId()
    {
        return $this->postId;
    }
}
