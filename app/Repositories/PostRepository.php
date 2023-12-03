<?php


namespace App\Repositories;


use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PostRepository implements PostRepositoryInterface
{

    public function index(int $page = 1, int $perPage = 10): LengthAwarePaginator
    {
        return Post::query()->with('translations')->with('tags:id,name')->paginate(perPage: $perPage, page: $page);

    }

    public function create(array $data): Post
    {
        DB::beginTransaction();
        /** @var Post $post */
        $post = Post::query()->create();
        $post->translations()->create($data);
        $post->tags()->sync($data['tags']);
        DB::commit();
        return $post;
    }

    public function find(int $id): Post
    {
        return Post::findOrFail($id);
    }

    public function update(int $id, array $data): Post
    {
        $post = $this->find($id);
        $post->translations()->upsert($data, [
            'post_id' => $data['post_id'],
            'language_id' => $data['language_id'],
        ]);
        $post->tags()->sync($data['tags']);
        return $post;
    }

    public function delete(int $id): void
    {
        $post = $this->find($id);
        $post->delete();
    }
}
