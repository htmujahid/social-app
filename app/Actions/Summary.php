<?php

namespace App\Actions;

use App\Models\Post;
use App\Models\PostComment;
use App\Models\User;

class Summary
{
    /**
     * Get the summary 
     */
    public function execute(): array
    {
        $users = User::all();
        $posts = Post::all();
        $comments = PostComment::all();
        $userOfWeek = User::withCount(['posts' => function($query){
            $query->whereBetween('created_at', [now()->subWeek(), now()]);
        }])->orderBy('posts_count', 'desc')->first();

        return [
            'userOfWeek' => $userOfWeek,
            'users_count' => $users->count(),
            'posts_count' => $posts->count(),
            'comments_count' => $comments->count(),
        ];
    }
}