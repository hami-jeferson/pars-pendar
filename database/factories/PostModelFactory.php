<?php

namespace Database\Factories;

use App\Models\PostModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostModel>
 */
class PostModelFactory extends Factory
{
    protected $model = PostModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create(['type'=>'admin']);
        return [
            'user_id'=> $user,
            'title'=> $this->faker->title,
            'content'=> $this->faker->text
        ];
    }
}
