<?php
namespace App\Contracts;

use App\DTOs\PostDTO;
use App\Models\PostModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface PostRepositoryInterface{
    public function add(User $user, PostDTO $data): PostModel;

    public function update(PostDTO $data, PostModel $post): PostModel;

    public function delete(PostModel $post): void;

    public function getBySlug(string $slug): PostModel|null;

    public function paginate(Request $request): LengthAwarePaginator;
}