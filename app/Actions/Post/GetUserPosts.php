<?php

namespace App\Actions\Post;

use App\Models\Post;
use App\Models\User;

class GetUserPosts
{
    /**
     * Get my posts
     */
    public function execute($id)
    {  
        if ($id == 'my') {
            $id = auth()->id();
        }

        $user = User::find($id);
        if (!$user) {
            return abort(404);
        }

        $posts = Post::with(['user' => function($query){
            $query->with('userMedia');
        }, 'postComments' => function ($query) {
            $query->with(['user' => function($query){
                $query->with('userMedia');
            }, 'postCommentReacts'])->orderBy('created_at', 'desc');
        }, 'postMedia', 'postReacts', 'postStats'])
        ->where('user_id', $id)
        ->orderBy('created_at', 'desc')->get();

        return $posts;
    }
}