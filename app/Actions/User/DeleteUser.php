<?php

namespace App\Actions\User;

use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostCommentReact;
use App\Models\PostMedia;
use App\Models\PostReact;
use App\Models\PostStat;
use App\Models\User;
use App\Models\UserMedia;

class DeleteUser
{
    public function execute($id)
    {
        if ( auth()->user()->hasRole('admin') ) {
            $post_comment_id = PostComment::where('user_id', $id)->pluck('id');
            PostCommentReact::whereIn('post_comment_id', $post_comment_id)->delete();
            PostComment::where('user_id', $id)->delete();

            PostReact::where('user_id', $id)->delete();
            PostStat::where('user_id', $id)->delete();

            $post_id = Post::where('user_id', $id)->pluck('id');
            PostMedia::whereIn('post_id', $post_id)->delete();
            Post::where('user_id', $id)->delete();
            UserMedia::where('user_id', $id)->delete();
            
            $user = User::find($id);
            if($user->hasRole('admin'))
            {
                $user->removeRole('admin');
            }
            if($user->hasRole('user'))
            {
                $user->removeRole('user');
            }
            return $user->delete();
        }
        return false;
    }
}