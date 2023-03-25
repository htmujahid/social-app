<?php

namespace App\Http\Controllers;

use App\Actions\Post\GetRelatedPosts;

class HomeController extends Controller
{   
    public function index()
    {
        $posts = (new GetRelatedPosts())->execute(auth()->user());
        return view('home.index',
            [
                'posts' => $posts,
            ]
        );
    }
}
