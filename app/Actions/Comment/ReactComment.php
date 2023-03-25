<?php

namespace App\Actions\Comment;

use App\Models\PostCommentReact;

class ReactComment
{
    public function execute($request, $id)
    {
        $react = PostCommentReact::where(
            [
                'user_id' => $request->user()->id,
                'post_comment_id' => $id,
            ]
        )->first();

        if ($react) {
            $react->delete();
        }

        return PostCommentReact::create(
            [
                'user_id' => $request->user()->id,
                'post_comment_id' => $id,
                'type' => $request->input('type'),
            ]
        );
    }
}