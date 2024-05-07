<?php

namespace Tests\Feature;

use App\DTOs\FeedbackDTO;
use App\Models\FeedbackModel;
use App\Models\PostModel;
use App\Models\User;
use App\Repositories\FeedbackRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeedbackRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    private $feedbackRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->feedbackRepository = new FeedbackRepository();
    }

    /** @test */
    public function it_can_add_or_update_feedback()
    {
        $user = User::factory()->create();
        $post = PostModel::factory()->create();
        $data = new FeedbackDTO('like', $user->id);
        $feedback = $this->feedbackRepository->addOrUpdate($post, $data);

        $this->assertInstanceOf(FeedbackModel::class, $feedback);
        $this->assertEquals('like', $feedback->action);
    }

    /** @test */
    public function it_can_get_feedback_by_id()
    {
        $feedback = FeedbackModel::factory()->create();
        $retrievedFeedback = $this->feedbackRepository->getById($feedback->id);

        $this->assertInstanceOf(FeedbackModel::class, $retrievedFeedback);
        $this->assertEquals($feedback->id, $retrievedFeedback->id);
    }

    /** @test */
    public function it_can_update_feedback()
    {
        $user  = User::factory()->create();
        $feedback = FeedbackModel::factory()->create(['user_id'=>$user->id]);
        $data = new FeedbackDTO('dislike', $user->id);
        $updatedFeedback = $this->feedbackRepository->update($feedback, $data);

        $this->assertInstanceOf(FeedbackModel::class, $updatedFeedback);
        $this->assertEquals('dislike', $updatedFeedback->action);
    }

    /** @test */
    public function it_can_delete_feedback()
    {
        $feedback = FeedbackModel::factory()->create();
        $this->feedbackRepository->delete($feedback);

        $this->assertDatabaseMissing(FeedbackModel::class, ['id'=>$feedback->id]);
    }

    /** @test */
    public function it_can_paginate_feedback_for_a_post()
    {
        $post = PostModel::factory()->create();
        $feedbacks = FeedbackModel::factory()->count(10)->create(['post_id' => $post->id]);

        $paginator = $this->feedbackRepository->paginate($post);

        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $paginator);
        $this->assertEquals(10, $paginator->count());
    }
}
