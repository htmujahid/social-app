<?php

namespace App\Actions\Comment;

use App\Models\PostComment;
use App\Models\PostCommentReact;

class DeleteComment
{
    public function execute($id)
    {
        if ( auth()->user()->hasRole('admin') || auth()->user()->id == PostComment::find($id)->user_id) {
            PostCommentReact::where('post_comment_id', $id)->delete();
            
            return PostComment::destroy($id);
        }
        return false;

    }
}