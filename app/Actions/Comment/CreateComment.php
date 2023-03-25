<?php

namespace App\Actions\Comment;

use App\Models\PostComment;

class CreateComment
{
    public function execute($request): PostComment
    {
        return PostComment::create(
            [
                'content' => $request->input('content'),
                'user_id' => $request->user()->id,
                'post_id' => $request->input('post_id'),
            ]
        );
    }
}