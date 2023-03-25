<?php

namespace App\Actions\Post;

use App\Models\Post;
use App\Models\PostReact;

class ReactPost
{
    public function execute($request, $id)
    {
        $post = Post::find($id);
        $post->reacts()->create(
            [
                'user_id' => $request->user()->id,
                'type' => 'like',
            ]
        );
    }
}