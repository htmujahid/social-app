<?php

namespace App\Http\Controllers\Post;

use App\Actions\Comment\CreateComment;
use App\Actions\Comment\DeleteComment;
use App\Actions\Comment\GetComments;
use App\Actions\Comment\ReactComment;
use App\Actions\Comment\UnreactComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, String $id)
    {
        $comments = (new GetComments())->execute($request, $id);

        return Inertia::render('Posts/Comments/Comments', [
            'comments' => $comments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $comment = (new CreateComment())->execute($request);

        return Redirect::to('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $postId, string $id)
    {
        $comment = (new DeleteComment())->execute($id);

        return Redirect::to('/');
    }

    /**
     * React to a comment.
     */
    public function react(Request $request, string $id)
    {
        $react = (new ReactComment())->execute($request, $id);

        return Redirect::to('/');
    }

    /**
     * Unreact to a comment.
     */
    public function unreact(Request $request, string $id)
    {
        $unreact = (new UnreactComment())->execute($request, $id);

        return Redirect::to('/');
    }

}
