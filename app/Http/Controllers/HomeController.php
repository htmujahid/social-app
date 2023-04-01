<?php

namespace App\Http\Controllers;

use App\Actions\Post\GetRelatedPosts;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{   
    public function index(GetRelatedPosts $getRelatedPosts): Response
    {
        $posts = $getRelatedPosts->execute();
        return Inertia::render('Home',
            [
                'posts' => $posts,
            ]
        );
    }
}
