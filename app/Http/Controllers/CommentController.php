<?php

namespace App\Http\Controllers;

use App\Models\PostComment;
use App\Models\PostCommentReact;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        PostComment::create(
            [
                'content' => $request->input('content'),
                'user_id' => $request->user()->id,
                'post_id' => $request->input('post_id'),
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * React to a comment.
     */
    public function react(Request $request, string $id)
    {
        $react = PostCommentReact::where(
            [
                'user_id' => $request->user()->id,
                'post_comment_id' => $id,
            ]
        )->first();

        if ($react) {
            $react->delete();
        }

        PostCommentReact::create(
            [
                'user_id' => $request->user()->id,
                'post_comment_id' => $id,
                'type' => $request->input('type'),
            ]
        );
    }

    /**
     * Unreact to a comment.
     */
    public function unreact(Request $request, string $id)
    {
        PostCommentReact::where(
            [
                'user_id' => $request->user()->id,
                'post_comment_id' => $id,
            ]
        )->delete();
    }



}
