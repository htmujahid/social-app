<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostComment;
use App\Models\User;

class DashboardController extends Controller
{
    
    public function index()
    {
        $users = User::all();
        $posts = Post::all();
        $comments = PostComment::all();
        // user of week is user who posted max post in last week
        $userOfWeek = User::withCount(['posts' => function($query){
            $query->whereBetween('created_at', [now()->subWeek(), now()]);
        }])->orderBy('posts_count', 'desc')->first();
        
        return view('dashboard.index',[
            'userOfWeek' => $userOfWeek,
            'users' => $users,
            'posts' => $posts,
            'comments' => $comments
        ]);
    }


}
