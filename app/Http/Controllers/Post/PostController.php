<?php

namespace App\Http\Controllers\Post;

use App\Actions\Post\CreatePost;
use App\Actions\Post\DeletePost;
use App\Actions\Post\GetUserPosts;
use App\Actions\Post\GetPosts;
use App\Actions\Post\ReactPost;
use App\Actions\Post\SetPostStat;
use App\Actions\Post\UnreactPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetPosts $getPosts): Response
    {
        $posts = $getPosts->execute();

        return Inertia::render('Posts/Posts', [
            'posts' => $posts,
        ]);
    }

    /**
     * Display resource related to the auth user.
     */

    public function userPosts(String $id, GetUserPosts $getUserPosts): Response
    {
        $posts = $getUserPosts->execute($id);

        return Inertia::render('Users/Posts', [
            'posts' => $posts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, CreatePost $createPost)
    {
        $post = $createPost->execute($request);

        return Redirect::to('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DeletePost $deletePost)
    {
        $post = $deletePost->execute($id);
        
        if(request()->route()->getName() == 'admin.posts.destroy')
        {
            return Redirect::route('admin.posts.index');
        }

        return Redirect::to('/');
    }

    /**
     * add a react to the specified resource.
     */
    public function react(Request $request, string $id, ReactPost $reactPost)
    {
        $post_react = $reactPost->execute($request, $id);

        return Redirect::to('/');
    }

    /**
     * remove a react from the specified resource.
     */
    public function unreact(Request $request, string $id, UnreactPost $unreactPost)
    {
        $post_unreact = $unreactPost->execute($request, $id);

        return Redirect::to('/');
    }
    
    /**
     * add a stat to the specified resource.
     */
    public function stat(Request $request, string $id, SetPostStat $setPostStat)
    {
        $post_stat = $setPostStat->execute($request, $id);

        return Redirect::to('/');
    }
}
