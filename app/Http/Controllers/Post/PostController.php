<?php

namespace App\Http\Controllers\Post;

use App\Actions\Post\CreatePost;
use App\Actions\Post\DeletePost;
use App\Actions\Post\GetUserPosts;
use App\Actions\Post\GetPosts;
use App\Models\PostReact;
use App\Models\PostStat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = (new GetPosts())->execute();

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Display resource related to the auth user.
     */

    public function userPosts(String $id)
    {
        $posts = (new GetUserPosts())->execute($id);

        return view('users.posts', [
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

        if (request()->routeIs('home')) {
            return redirect()->route('home');
        } else {
            return redirect()->route('admin.posts.index');
        }

    }

    /**
     * add a react to the specified resource.
     */
    public function react(Request $request, string $id)
    {
        PostReact::create(
            [
                'post_id' => $id,
                'user_id' => $request->user()->id,
                'type' => $request->input('type'),
            ]
        );
    }

    /**
     * remove a react from the specified resource.
     */
    public function unreact(Request $request, string $id)
    {
        PostReact::where('post_id', $id)->where('user_id', $request->user()->id)->delete();
    }
    
    /**
     * add a stat to the specified resource.
     */
    public function stat(Request $request, string $id)
    {

        PostStat::create(
            [
                'post_id' => $id,
                'user_id' => $request->user()->id,
            ]
        );
    }
}
