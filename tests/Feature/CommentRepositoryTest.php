<?php

namespace Tests\Feature;

use App\DTOs\CommentDTO;
use App\Models\CommentModel;
use App\Models\PostModel;
use App\Repositories\CommentRepository;
use http\Client\Curl\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    private $commentRepository;
    public function setUp(): void
    {
        parent::setUp();
        $this->commentRepository = new CommentRepository();
    }

    /** @test */
    public function it_can_add_or_update_a_comment()
    {
        $user = \App\Models\User::factory()->create();
        $post = PostModel::factory()->create(['user_id'=>$user->id]);
        $data = new CommentDTO(4, $user->id, 'Test comment');
        $comment = $this->commentRepository->addOrUpdate($post, $data);

        $this->assertInstanceOf(CommentModel::class, $comment);
        $this->assertEquals(4, $comment->rate);
        $this->assertEquals('Test comment', $comment->comment);
    }

    /** @test */
    public function it_can_get_a_comment_by_id()
    {
        $comment = CommentModel::factory()->create();
        $retrievedComment = $this->commentRepository->getById($comment->id);

        $this->assertInstanceOf(CommentModel::class, $retrievedComment);
        $this->assertEquals($comment->id, $retrievedComment->id);
    }

    /** @test */
    public function it_can_update_a_comment()
    {
        $comment = CommentModel::factory()->create();
        $data = new CommentDTO(5, $comment->user_id, 'Updated comment');
        $updatedComment = $this->commentRepository->update($comment, $data);

        $this->assertInstanceOf(CommentModel::class, $updatedComment);
        $this->assertEquals(5, $updatedComment->rate);
        $this->assertEquals('Updated comment', $updatedComment->comment);
    }

    /** @test */
    public function it_can_delete_a_comment()
    {
        $comment = CommentModel::factory()->create();
        $this->commentRepository->delete($comment);

        $this->assertDatabaseMissing(CommentModel::class, ['id'=>$comment->id]);
    }

    /** @test */
    public function it_can_paginate_comments_for_a_post()
    {
        $post = PostModel::factory()->create();
        $comments = CommentModel::factory()->count(10)->create(['post_id' => $post->id]);

        $paginator = $this->commentRepository->paginate($post);

        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $paginator);
        $this->assertEquals(10, $paginator->count());
    }
}
