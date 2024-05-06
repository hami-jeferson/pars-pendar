<?php
namespace App\Contracts;

use App\DTOs\CommentDTO;
use App\Models\CommentModel;
use App\Models\User;

interface CommentRepositoryInterface{
    public function add(User $user, CommentDTO $data, string $postSlug): CommentModel;
}