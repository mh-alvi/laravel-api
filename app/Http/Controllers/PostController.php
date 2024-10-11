<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::get();
        return $this->successResponse($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->validated());
        return $this->successResponse($post);
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::whereId($id)->first();
        if (!$post) {
            return $this->errorResponse('Post not found');
        }
        return $this->successResponse($post);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::whereId($id)->first();
        $post->update($request->validated());

        if (!$post) {
            return $this->errorResponse('Post not found');
        }
        return $this->successResponse($post, 'Post Updated!!', 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::whereId($id)->first();
        if (!$post) {
            return $this->errorResponse('Post not found');
        }
        $post->delete();
        return $this->successResponse(null, 'Post Deleted!!');
    }
}
