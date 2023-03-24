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
    public function index(String $id)
    {
        $query = request()->query();

        if ($id == '_') {
            if (isset($query['user_id'])) {
                $comments = PostComment::where('user_id', $query['user_id'])->get();
            } else {
                $comments = PostComment::all();
            }
        } else {
            if (isset($query['user_id'])) {
                $comments = PostComment::where('user_id', $query['user_id'])->where('post_id', $id)->get();
            } else {
                $comments = PostComment::where('post_id', $id)->get();
            }
        }
        return view('posts.comments.index', [
            'comments' => $comments,
        ]);
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $postId, string $id)
    {
        PostComment::destroy($id);
        return redirect()->route('admin.comments.index', ['_']);
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
