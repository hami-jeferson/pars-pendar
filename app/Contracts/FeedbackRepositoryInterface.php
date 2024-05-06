<?php
namespace App\Contracts;

use App\DTOs\FeedbackDTO;
use App\Models\FeedbackModel;
use App\Models\PostModel;
use Illuminate\Pagination\LengthAwarePaginator;

interface FeedbackRepositoryInterface{
    public function addOrUpdate(PostModel $post, FeedbackDTO $data): FeedbackModel;

    public function getById(int $id): FeedbackModel|null;

    public function update(FeedbackModel $feedback, FeedbackDTO $data): FeedbackModel;

    public function delete(FeedbackModel $feedback): void;

    public function paginate(PostModel $post): LengthAwarePaginator;
}