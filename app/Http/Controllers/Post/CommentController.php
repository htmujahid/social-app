<?php

namespace App\Http\Controllers\Post;

use App\Actions\Comment\CreateComment;
use App\Actions\Comment\DeleteComment;
use App\Actions\Comment\GetComments;
use App\Actions\Comment\ReactComment;
use App\Actions\Comment\UnreactComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreCommentRequest;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, String $id, GetComments $getComments)
    {
        $comments = $getComments->execute($request, $id);

        return Inertia::render('Posts/Comments/Comments', [
            'comments' => $comments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, CreateComment $createComment)
    {
        $comment = $createComment->execute($request);

        return Redirect::to('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $postId, string $id, DeleteComment $deleteComment)
    {
        $comment = $deleteComment->execute($id);

        if(request()->route()->getName() == 'admin.comments.destroy')
        {
            return Redirect::route('admin.comments.index', '_');
        }

        return Redirect::to('/');
    }

    /**
     * React to a comment.
     */
    public function react(Request $request, string $id, ReactComment $reactComment)
    {
        $react = $reactComment->execute($request, $id);

        return Redirect::to('/');
    }

    /**
     * Unreact to a comment.
     */
    public function unreact(Request $request, string $id, UnreactComment $unreactComment)
    {
        $unreact = $unreactComment->execute($request, $id);
        
        return Redirect::to('/');
    }

}
