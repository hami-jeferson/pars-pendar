<?php
namespace App\Repositories;

use App\Contracts\CommentRepositoryInterface;
use App\DTOs\CommentDTO;
use App\Models\CommentModel;
use App\Models\PostModel;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentRepository implements CommentRepositoryInterface {

    public function getById(int $id): CommentModel|null
    {
        return CommentModel::find($id);
    }

    public function addOrUpdate(PostModel $post, CommentDTO $data): CommentModel
    {
        $comment = $post->comment()->UserId($data->getUserId())->first();
        if(!empty($comment)){ // update comment
            $comment->rate = $data->getRate();
            $comment->comment = $data->getComment();
            $comment->save();
        }else{ // new comment
            $comment = new CommentModel(['rate'=>$data->getRate(),
                                         'comment'=>$data->getComment(),
                                         'user_id'=>$data->getUserId()]);
            $post->comment()->save($comment);

        }

        return $comment;
    }

    public function update(CommentModel $comment, CommentDTO $data): CommentModel
    {
        $comment->update(['rate'=>$data->getRate(), 'comment'=>$data->getComment()]);
        return $comment;
    }

    public function delete(CommentModel $comment): void
    {
        $comment->delete();
    }

    public function paginate(PostModel $post): LengthAwarePaginator
    {
        return $post->comment()->paginate();
    }
}
