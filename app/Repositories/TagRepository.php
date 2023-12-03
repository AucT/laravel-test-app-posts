<?php


namespace App\Repositories;


use App\Models\Tag;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TagRepository implements TagRepositoryInterface
{

    public function index(int $page = 1, int $perPage = 10): LengthAwarePaginator
    {
        return Tag::query()->paginate(perPage: $perPage, page: $page);

    }

    public function create(array $data): Tag
    {
        return Tag::query()->create($data);
    }

    public function find(int $id): Tag
    {
        return Tag::findOrFail($id);
    }

    public function update(int $id, array $data): Tag
    {
        $tag = $this->find($id);
        $tag->update($data);
        return $tag;
    }

    public function delete(int $id): void
    {
        $tag = $this->find($id);
        $tag->delete();
    }
}
