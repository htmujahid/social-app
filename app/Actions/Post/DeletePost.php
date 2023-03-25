<?php

namespace App\Actions\Post;

use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostCommentReact;
use App\Models\PostMedia;
use App\Models\PostReact;
use App\Models\PostStat;

class DeletePost
{
    public function execute($id)
    {
        if ( auth()->user()->hasRole('admin') || auth()->user()->id == Post::find($id)->user_id) {
            $post_comment_id = PostComment::where('post_id', $id)->pluck('id');
            PostCommentReact::whereIn('post_comment_id', $post_comment_id)->delete();
            PostComment::where('post_id', $id)->delete();

            PostReact::where('post_id', $id)->delete();
            PostStat::where('post_id', $id)->delete();

            PostMedia::where('post_id', $id)->delete();
            return Post::destroy($id);   
        }
        return false;
    }
}