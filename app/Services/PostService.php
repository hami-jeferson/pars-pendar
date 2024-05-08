<?php
namespace App\Services;

use App\Contracts\ImageRepositoryInterface;
use App\Contracts\PostRepositoryInterface;
use App\DTOs\PostDTO;
use App\Http\Resources\PostDetailsResource;
use App\Models\PostModel;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostService{
    use Response;
    private $postRepository;
    private $imageRepository;

    public function __construct(PostRepositoryInterface $postRepository, ImageRepositoryInterface $imageRepository)
    {
        $this->postRepository = $postRepository;
        $this->imageRepository = $imageRepository;
    }

    public function paginatePost(Request $request)
    {
        return $this->postRepository->paginate($request);
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

    public function getPost(PostModel $post): JsonResponse
    {
        return $this->successResource(data: new PostDetailsResource($post));
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
        }else{
            $postDTO->setImageId($post->image_id);
        }
        if ($request->has('delete_image') && $request->get('delete_image') == 1) {
            // delete old image
            $this->imageRepository->delete($post->image);
            $postDTO->setImageId(null);
        }
        $updatedPost = $this->postRepository->update($postDTO, $post);
        $updatedPost->load('image');

        return $updatedPost;
    }

    public function deletePost(PostModel $post)
    {
        // delete image
        $this->imageRepository->delete($post->image);
        return $this->postRepository->delete($post);
    }

}