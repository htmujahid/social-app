<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{   
    public function index()
    {
        $posts = Post::with(['user', 'postComments' => function ($query) {
            $query->with('user', 'postCommentReacts')->orderBy('created_at', 'desc');
        }, 'postMedia', 'postReacts', 'postStats'])->orderBy('created_at', 'desc')->get();
        
        return view('home.index',
            [
                'posts' => $posts,
            ]
        );
    }
}
