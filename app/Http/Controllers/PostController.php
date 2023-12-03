<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostController extends Controller
{
    private PostRepositoryInterface $postRepository;


    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index(): ResourceCollection
    {
        return PostResource::collection($this->postRepository->index(intval(request('page', 1)), 10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): Post
    {
        $post = $this->postRepository->create($request->validated());
        return $post->load('translations')->load('tags:id,name');
    }

    /**
     * Display the specified resource.
     */

    public function show(int $id): PostResource
    {
        $post = $this->postRepository->find($id);
        $post->load('translations')->load('tags:id,name');
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, int $id): PostResource
    {
        return new PostResource($this->postRepository->update($id, $request->validated())->load('translations')->load('tags:id,name'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): Response
    {
        $this->postRepository->delete($id);
        return response()->noContent();
    }
}
