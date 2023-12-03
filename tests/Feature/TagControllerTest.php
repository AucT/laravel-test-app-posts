<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class TagControllerTest extends TestCase
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
            'name' => fake()->word(),
        ];

        $response = $this->postJson(route('tags.store'), $postData);
        $response->assertCreated();
    }

    public function testIndex()
    {
        Tag::factory()->count(2)->create();
        $response = $this->getJson(route('posts.index'));
        $response->assertOk();
    }

    public function testShow()
    {
        $tag = Tag::factory()->create();
        $response = $this->getJson(route('tags.show', $tag->id));
        $response->assertOk();
    }

    public function testUpdate()
    {
        $tag = Tag::factory()->create();
        $postData = [
            'name' => fake()->word(),
        ];


        $response = $this->putJson(route('tags.update', $tag->id), $postData);
        $response->assertOk();
        $response->assertJson($postData);
    }

    public function testDestroy()
    {
        $tag = Tag::factory()->create();
        $response = $this->deleteJson(route('tags.destroy', $tag->id));
        $response->assertNoContent();
    }
}
