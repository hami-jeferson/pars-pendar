<?php
namespace App\Services\Api;

use App\Contracts\FeedbackRepositoryInterface;
use App\DTOs\FeedbackDTO;
use App\Models\FeedbackModel;
use App\Models\PostModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackService{
    private $feedbackRepository;

    public function __construct(FeedbackRepositoryInterface $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    public function paginateFeedback(PostModel $post)
    {
        return $this->feedbackRepository->paginate($post);
    }

    public function addFeedback(Request $request, PostModel $post): FeedbackModel
    {
        $feedbackDTO = new FeedbackDTO(action: $request->get('action'),
                                       userId: Auth::user()->id);
        return $this->feedbackRepository->addOrUpdate($post, $feedbackDTO);
    }

    public function updateFeedback(Request $request, FeedbackModel $feedback): FeedbackModel
    {
        $feedbackDTO = new FeedbackDTO(action: $request->get('action'),  userId: \auth()->id());
        return $this->feedbackRepository->update($feedback, $feedbackDTO);
    }

    public function deleteFeedback(FeedbackModel $feedback): void
    {
        $this->feedbackRepository->delete($feedback);
    }
}