<?php
namespace App\Repositories;

use App\Contracts\CommentRepositoryInterface;
use App\DTOs\CommentDTO;
use App\Models\CommentModel;
use App\Models\User;

class CommentRepository implements CommentRepositoryInterface {
    public function add(User $user, CommentDTO $data, int $postId): CommentModel
    {
        $comment = new CommentModel(['rate'=>$data->getRate(), 'comment'=>$data->getComment()]);
        return $user->post()->PostId($postId)->comment()->save($comment);
    }
}
