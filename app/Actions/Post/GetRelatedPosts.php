<?php

namespace App\Actions\Post;

use App\Models\Friend;
use App\Models\Post;

class GetRelatedPosts
{
    /**
     * Get the related posts of the user.
     */
    public function execute()
    {
        $current_friends = Friend::where(function ($query) {
            $query->where('user_id', auth()->id())
                  ->orWhere('friend_id', auth()->id());
            })
            ->whereNotNull('accepted')
            ->get();

        $friends_id = [
            auth()->id()
        ];

        foreach ($current_friends as $friend) {
            if ($friend->user_id == auth()->id()) {
                $friends_id[] = $friend->friend_id;
            } else {
                $friends_id[] = $friend->user_id;
            }
        }
    

        $posts = Post::with(['user' => function($query){
            $query->with('userMedia');
        }, 'postComments' => function ($query) {
            $query->with(['user' => function($query){
                $query->with('userMedia');
            }, 'postCommentReacts'])->orderBy('created_at', 'desc');
        }, 'postMedia', 'postReacts', 'postStats'])
        ->whereIn('user_id', $friends_id)
        ->orderBy('created_at', 'desc')->get();
        

        return $posts;
    }
}