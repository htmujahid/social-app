<?php

namespace App\Actions\Post;

use App\Models\Post;
use App\Models\PostReact;

class UnreactPost
{
    public function execute($request, $id)
    {
        $post = Post::find($id);
        $post->reacts()->where('user_id', $request->user()->id)->delete();
    }
}