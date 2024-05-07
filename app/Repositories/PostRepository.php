<?php
namespace App\Repositories;

use App\Contracts\PostRepositoryInterface;
use App\DTOs\PostDTO;
use App\Models\PostModel;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpParser\Node\NullableType;

class PostRepository implements PostRepositoryInterface {
    public function add(User $user, PostDTO $data): PostModel
    {
        $post = new PostModel(['title'=>$data->getTitle(), 'content'=>$data->getContent(), 'image_id'=>$data->getImageId()]);
        return $user->post()->save($post);
    }

    public function getBySlug(string $slug): PostModel|null
    {
        return PostModel::where('slug', $slug)->first();
    }

    public function update(PostDTO $data, PostModel $post): PostModel
    {
        $post->update(['title'=>$data->getTitle(), 'content'=>$data->getContent()]);
        return $post;
    }

    public function delete(PostModel $post): void
    {
        $post->delete();
    }

    public function paginate(): LengthAwarePaginator
    {
        return PostModel::paginate();
    }
}
