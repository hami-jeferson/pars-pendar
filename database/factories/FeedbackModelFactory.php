<?php

namespace Database\Factories;

use App\Models\PostModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FeedbackModel>
 */
class FeedbackModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        $post = PostModel::factory()->create();
        return [
            'user_id'=> $user->id,
            'post_id'=> $post->id,
            'action'=> $this->faker->randomElements(['like', 'dislike'])[0]
        ];
    }
}
