<?php

namespace App\Http\Controllers\Post;

use App\Actions\Comment\CreateComment;
use App\Actions\Comment\DeleteComment;
use App\Actions\Comment\GetComments;
use App\Actions\Comment\ReactComment;
use App\Actions\Comment\UnreactComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, String $id)
    {
        $comments = (new GetComments())->execute($request, $id);

        return view('posts.comments.index', [
            'comments' => $comments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $comment = (new CreateComment())->execute($request);

        return redirect()->route('admin.comments.index', ['_']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $postId, string $id)
    {
        $comment = (new DeleteComment())->execute($id);

        return redirect()->route('admin.comments.index', ['_']);
    }

    /**
     * React to a comment.
     */
    public function react(Request $request, string $id)
    {
        $react = (new ReactComment())->execute($request, $id);

        return redirect()->route('home', ['_']);
    }

    /**
     * Unreact to a comment.
     */
    public function unreact(Request $request, string $id)
    {
        $unreact = (new UnreactComment())->execute($request, $id);

        return redirect()->route('home', ['_']);
    }

}
