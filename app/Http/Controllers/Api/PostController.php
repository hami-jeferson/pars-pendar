<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostResource;
use App\Models\PostModel;
use App\Services\Api\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\Response;

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
    public function index(): JsonResponse
    {
        return $this->paginateResponse(PostResource::collection($this->postService->paginatePost()));
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
    public function show(string $slug): JsonResponse
    {
        return $this->postService->getPost($slug);
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
