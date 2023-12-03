<?php

namespace App\Repositories;

use App\Models\Tag;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TagRepositoryInterface
{
    public function index(int $page = 1, int $perPage = 10): LengthAwarePaginator;

    public function create(array $data): Tag;

    public function find(int $id): Tag;

    public function update(int $id, array $data): Tag;

    public function delete(int $id): void;
}
