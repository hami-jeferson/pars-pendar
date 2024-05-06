<?php
namespace App\Repositories;

use App\Contracts\CommentRepositoryInterface;
use App\DTOs\CommentDTO;
use App\Models\CommentModel;
use App\Models\User;

class CommentRepository implements CommentRepositoryInterface {
    public function add(User $user, CommentDTO $data, string $postSlug): CommentModel
    {
        $comment = new CommentModel(['rate'=>$data->getRate(), 'comment'=>$data->getComment()]);
        return $user->post()->PostSlug($postSlug)->comment()->save($comment);
    }
}
