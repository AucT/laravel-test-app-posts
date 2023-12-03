<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [];
    }

    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            $tags = Tag::query()->inRandomOrder()->take(2)->pluck('id')->all();
            $post->tags()->attach($tags);
            $post->translations()->create([
                'title' => $this->faker->sentence(),
                'description' => $this->faker->sentence(),
                'content' => $this->faker->paragraph(),
                'language_id' => 1,
            ]);
        });
    }
}
