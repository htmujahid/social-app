<?php

namespace App\Actions\Post;

use App\Models\Post;

class GetPosts
{
    public function execute()
    {
        $query = request()->query();
        
        if (isset($query['user_id'])) {
            $posts = Post::where('user_id', $query['user_id'])->with('user', 'postComments', 'postMedia', 'postStats', 'postReacts')->get();
        }
        else {
            $posts = Post::with('user', 'postComments', 'postMedia', 'postStats', 'postReacts')->get();
        }

        return $posts;
    }
}