<?php

namespace App\Actions\Comment;

use App\Models\PostComment;
use App\Models\PostCommentReact;

class DeleteComment
{
    public function execute($id)
    {
        PostCommentReact::where('post_comment_id', $id)->delete();
        
        return PostComment::destroy($id);
    }
}