<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PostRepositoryInterface
{
    public function index(int $page = 1, int $perPage = 10): LengthAwarePaginator;

    public function create(array $data): Post;

    public function find(int $id): Post;

    public function update(int $id, array $data): Post;

    public function delete(int $id): void;
}
