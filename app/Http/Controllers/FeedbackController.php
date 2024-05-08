<?php

namespace App\Http\Controllers;

use App\Http\Resources\FeedbackResource;
use App\Models\FeedbackModel;
use App\Models\PostModel;
use App\Services\FeedbackService;
use App\Traits\Response;
use Illuminate\Http\Request;

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
