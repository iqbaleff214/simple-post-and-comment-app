<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        try {
            Post::create(array_merge($request->validated(), ['user_id' => auth()->user()->id]));
            return back();
        } catch (\Exception $exception) {
            return back()->with('message', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {
        $post->load(['comments', 'comments.author']);
        return \view('posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {
        $post->load(['comments', 'comments.author']);
        return \view('posts.edit', [
            'post' => $post,
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        try {
            $post->update($request->validated());
            return \redirect()->route('posts.show', $post);
        } catch (\Exception $exception) {
            return back()->with('message', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        try {
            $post->delete();
            return \redirect()->route('dashboard');
        } catch (\Exception $exception) {
            return back()->with('message', $exception->getMessage());
        }
    }
}
