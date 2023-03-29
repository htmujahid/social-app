<?php

namespace App\Http\Controllers;

use App\Actions\Post\GetRelatedPosts;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{   
    public function index(): Response
    {
        $posts = (new GetRelatedPosts())->execute(auth()->user());
        return Inertia::render('Home',
            [
                'posts' => $posts,
            ]
        );
    }
}
