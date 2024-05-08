<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\PostModel;
use App\Services\PostService;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use Response;
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        return $this->paginateResponse(PostResource::collection($this->postService->paginatePost($request)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        return $this->successResource(data: new PostResource($this->postService->addPost($request)));
    }

    /**
     * Display the specified resource.
     */
    public function show(PostModel $post): JsonResponse
    {
        return $this->postService->getPost($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PostModel $post): JsonResponse
    {
        return $this->successResource(data: new PostResource($this->postService->updatePost($request, $post)));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostModel $post): JsonResponse
    {
        $this->postService->deletePost($post);
        return $this->success(data: [], msg: 'Post deleted successfully');
    }
}
