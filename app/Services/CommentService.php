<?php
namespace App\Services;

use App\Contracts\CommentRepositoryInterface;
use App\DTOs\CommentDTO;
use App\Models\CommentModel;
use App\Models\PostModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentService{
    private $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function paginateComment(PostModel $post)
    {
        return $this->commentRepository->paginate($post);
    }

    public function addComment(Request $request, PostModel $post): CommentModel
    {
        $commentDTO = new CommentDTO(rate: $request->get('rate'),
                                     userId: Auth::user()->id,
                                     comment: $request->get('comment'));
        return $this->commentRepository->addOrUpdate($post, $commentDTO);
    }

    public function updateComment(Request $request, CommentModel $comment): CommentModel
    {
        $commentDTO = new CommentDTO(rate: $request->get('rate'), comment: $request->get('comment'), userId: \auth()->id());
        return $this->commentRepository->update($comment, $commentDTO);
    }

    public function deleteComment(CommentModel $comment): void
    {
        $this->commentRepository->delete($comment);
    }
}