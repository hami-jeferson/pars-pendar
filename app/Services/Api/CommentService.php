<?php
namespace App\Services\Api;

use App\Contracts\CommentRepositoryInterface;
use App\DTOs\CommentDTO;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentService{
    private $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function addComment(Request $request, slug $slug)
    {
        $commentDTO = new CommentDTO(rate: $request->get('rate'), comment: $request->get('comment'));
        $this->commentRepository->add(Auth::user(), $commentDTO, $postId);
    }
}