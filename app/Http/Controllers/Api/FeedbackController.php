<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\FeedbackResource;
use App\Models\FeedbackModel;
use App\Models\PostModel;
use App\Services\Api\FeedbackService;
use Illuminate\Http\Request;
use App\Traits\Response;
class FeedbackController extends Controller
{
    use Response;
    private $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(PostModel $post)
    {
        return $this->paginateResponse(FeedbackResource::collection($this->feedbackService->paginateFeedback($post)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, PostModel $post)
    {
        return $this->successResource(data: new FeedbackResource($this->feedbackService->addFeedback($request, $post)),
                                      msg: 'Feedback added successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FeedbackModel $feedback)
    {
        return $this->successResource(data: new FeedbackResource($this->feedbackService->updateFeedback($request, $feedback)),
                                      msg: 'Feedback updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeedbackModel $feedback)
    {
        $this->feedbackService->deleteFeedback($feedback);
        return $this->success(data: [], msg: 'Feedback deleted successfully');
    }
}
