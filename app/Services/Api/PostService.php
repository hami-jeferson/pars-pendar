<?php
namespace App\Services\Api;

use App\Contracts\ImageRepositoryInterface;
use App\Contracts\PostRepositoryInterface;
use App\DTOs\ImageDTO;
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
    private $imageRepository;

    public function __construct(PostRepositoryInterface $postRepository, ImageRepositoryInterface $imageRepository)
    {
        $this->postRepository = $postRepository;
        $this->imageRepository = $imageRepository;
    }

    public function paginatePost()
    {
        return $this->postRepository->paginate();
    }
    public function addPost(Request $request): PostModel
    {
        $postDTO = new PostDTO(title: $request->get('title'), content: $request->get('content'));
        // upload post image if exist
        $image = $this->imageRepository->upload($request);
        if(!empty($image)){
            $postDTO->setImageId($image->id);
        }

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
        // upload post image if exist
        $image = $this->imageRepository->upload($request);
        if(!empty($image)){
            // delete old image
            $this->imageRepository->delete($post->image);
            $postDTO->setImageId($image->id);
        }
        if ($request->has('delete_image')) {
            // delete old image
            $this->imageRepository->delete($post->image);
        }
        return $this->postRepository->update($postDTO, $post);
    }

    public function deletePost(PostModel $post)
    {
        // delete image
        $this->imageRepository->delete($post->image);
        return $this->postRepository->delete($post);
    }

}