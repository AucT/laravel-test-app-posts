<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class PostControllerTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }


    public function testStore()
    {
        $postData = [
            'title' => fake()->sentence(3),
            'description' => 'string',
            'content' => fake()->sentence(10),
            'language_id' => 1,
            'tags' => [1, 2],
        ];

        $response = $this->postJson(route('posts.store'), $postData);
        $response->assertSuccessful();
    }

    public function testIndex()
    {
        Post::factory()->count(2)->create();
        $response = $this->getJson(route('posts.index'));
        $response->assertOk();
    }

    public function testShow()
    {
        $post = Post::factory()->create();
        $response = $this->getJson(route('posts.show', ['post' => $post->id]));
        $response->assertOk();
    }

    public function testUpdate()
    {
        /** @var Post $post */
        $post = Post::factory()->create();
        $count = $post->translations()->count();
        $postData = [
            'title' => fake()->sentence(3),
            'description' => fake()->sentence(5),
            'content' => fake()->sentence(10),
            'language_id' => 1,
            'tags' => [1],
        ];

        $response = $this->putJson(route('posts.update', $post->id), $postData);
        self::assertEquals($count, $post->translations()->count());

        $response->assertOk();
    }

    public function testDestroy()
    {
        $post = Post::factory()->create();
        $response = $this->deleteJson(route('posts.destroy', $post->id));
        $response->assertNoContent();
    }
}
