<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\CommentModel;
use App\Models\PostModel;
use App\Services\CommentService;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use Response;
    private $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(PostModel $post)
    {
        return $this->paginateResponse(CommentResource::collection($this->commentService->paginateComment($post)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, PostModel $post): JsonResponse
    {
        return $this->successResource(data: new CommentResource($this->commentService->addComment($request, $post)),
                                      msg: 'Comment added successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommentModel $comment): JsonResponse
    {
        return $this->successResource(data: new CommentResource($this->commentService->updateComment($request, $comment)),
                                      msg: 'Comment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommentModel $commentModel)
    {
        $this->commentService->deleteComment($commentModel);
        return $this->success(data: [], msg: 'Comment deleted successfully');
    }
}
