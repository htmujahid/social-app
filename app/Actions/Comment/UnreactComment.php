<?php

namespace App\Actions\Comment;

use App\Models\PostComment;
use App\Models\PostCommentReact;

class UnreactComment
{
    public function execute($request, $id)
    {
        return PostCommentReact::where(
            [
                'user_id' => $request->user()->id,
                'post_comment_id' => $id,
            ]
        )->delete();
    }
}