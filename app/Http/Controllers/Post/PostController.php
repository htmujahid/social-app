<?php

namespace App\Http\Controllers\Post;

use App\Actions\Post\CreatePost;
use App\Actions\Post\DeletePost;
use App\Actions\Post\GetUserPosts;
use App\Actions\Post\GetPosts;
use App\Actions\Post\ReactPost;
use App\Actions\Post\SetPostStat;
use App\Actions\Post\UnreactPost;
use App\Models\PostReact;
use App\Models\PostStat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = (new GetPosts())->execute();

        return Inertia::render('Posts/Posts', [
            'posts' => $posts,
        ]);
    }

    /**
     * Display resource related to the auth user.
     */

    public function userPosts(String $id): Response
    {
        $posts = (new GetUserPosts())->execute($id);

        return Inertia::render('Users/Posts', [

            'posts' => $posts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = (new CreatePost())->execute($request);

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = (new DeletePost())->execute($id);
        
        return $post;

    }

    /**
     * add a react to the specified resource.
     */
    public function react(Request $request, string $id)
    {
        $post_react = (new ReactPost())->execute($request, $id);
    }

    /**
     * remove a react from the specified resource.
     */
    public function unreact(Request $request, string $id)
    {
        $post_unreact = (new UnreactPost())->execute($request, $id);
        return $post_unreact;
    }
    
    /**
     * add a stat to the specified resource.
     */
    public function stat(Request $request, string $id)
    {

        $post_stat = (new SetPostStat())->execute($request, $id);
    }
}
