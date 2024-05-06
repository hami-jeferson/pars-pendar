<?php
namespace App\Services\Api;

use App\Contracts\PostRepositoryInterface;
use App\DTOs\PostDTO;
use App\Http\Resources\Api\PostResource;
use App\Models\PostModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\Response;
class PostService{
    use Response;
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function paginatePost()
    {
        return $this->postRepository->paginate();
    }
    public function addPost(Request $request): PostModel
    {
        $postDTO = new PostDTO(title: $request->get('title'), content: $request->get('content'));
        return $this->postRepository->add(Auth::user(), $postDTO);
    }

    public function getPost(string $slug): JsonResponse
    {
        $post = $this->postRepository->getBySlug($slug);
        if(!empty($post)){
            $res = $this->successResource(data: new PostResource($post));
        }else{
            $res = $this->error(msg: 'Post not found');
        }

        return $res;
    }

    public function updatePost(Request $request, PostModel $post): PostModel
    {
        $postDTO = new PostDTO(title: $request->get('title'), content: $request->get('content'));
        return $this->postRepository->update($postDTO, $post);
    }

    public function deletePost(PostModel $post)
    {
        return $this->postRepository->delete($post);
    }

}