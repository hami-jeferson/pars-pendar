<?php
namespace App\Contracts;

use App\DTOs\CommentDTO;
use App\Models\CommentModel;
use App\Models\PostModel;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface CommentRepositoryInterface{
    public function addOrUpdate(PostModel $post, CommentDTO $data): CommentModel;

    public function getById(int $id): CommentModel|null;

    public function update(CommentModel $comment, CommentDTO $data): CommentModel;

    public function delete(CommentModel $comment): void;

    public function paginate(PostModel $post): LengthAwarePaginator;
}