<?php

namespace Database\Factories;

use App\Models\CommentModel;
use App\Models\PostModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommentModel>
 */
class CommentModelFactory extends Factory
{
    protected $model = CommentModel::class;
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
            'rate'=> $this->faker->numberBetween(1, 5),
            'comment'=> $this->faker->text
        ];
    }
}
