<?php

namespace Tests\Feature;

use App\DTOs\PostDTO;
use App\Models\PostModel;
use App\Models\User;
use App\Repositories\PostRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    protected $postRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->postRepository = new PostRepository();
    }

    /** @test */
    public function it_can_add_a_post()
    {
        $user = User::factory()->create();
        $data = new PostDTO('Test Title', 'Test Content');
        $post = $this->postRepository->add($user, $data);

        $this->assertInstanceOf(PostModel::class, $post);
        $this->assertEquals('Test Title', $post->title);
        $this->assertEquals('Test Content', $post->content);
    }

    /** @test */
    public function it_can_get_a_post_by_slug()
    {
        $post = PostModel::factory()->create(['title'=>'test post']);
        $retrievedPost = $this->postRepository->getBySlug('test-post');

        $this->assertInstanceOf(PostModel::class, $retrievedPost);
        $this->assertEquals($post->id, $retrievedPost->id);
    }

    /** @test */
    public function it_can_update_a_post()
    {
        $post = PostModel::factory()->create();
        $data = new PostDTO('Updated Title', 'Updated Content');
        $updatedPost = $this->postRepository->update($data, $post);

        $this->assertInstanceOf(PostModel::class, $updatedPost);
        $this->assertEquals('Updated Title', $updatedPost->title);
        $this->assertEquals('Updated Content', $updatedPost->content);
    }

    /** @test */
    public function it_can_delete_a_post()
    {
        $post = PostModel::factory()->create();
        $this->postRepository->delete($post);

        $this->assertDatabaseMissing(PostModel::class, ['id'=>$post->id]);
    }

    /** @test */
    public function it_can_paginate_posts()
    {
        $request = new Request();
        PostModel::factory(10)->create();
        $paginator = $this->postRepository->paginate($request);

        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $paginator);
        $this->assertEquals(10, $paginator->count());
    }
}
