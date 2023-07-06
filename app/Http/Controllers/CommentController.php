<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request): RedirectResponse
    {
        try {
            Comment::create(array_merge($request->validated(), ['user_id' => auth()->user()->id]));
            return back();
        } catch (\Exception $exception) {
            return back()->with('message', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        try {
            $comment->delete();
            return back();
        } catch (\Exception $exception) {
            return back()->with('message', $exception->getMessage());
        }
    }
}
