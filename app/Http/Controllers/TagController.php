<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Models\Tag;
use App\Repositories\TagRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TagController extends Controller
{
    private TagRepositoryInterface $tagRepository;

    /**
     * TagController constructor.
     */
    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(): LengthAwarePaginator
    {
        return $this->tagRepository->index(intval(request('page', 1)), 10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request): Tag
    {
        return $this->tagRepository->create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag): Tag
    {
        return $this->tagRepository->find($tag->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTagRequest $request, int $id): Tag
    {
        return $this->tagRepository->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): void
    {
        $this->tagRepository->delete($id);
    }
}
