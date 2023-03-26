<?php

namespace App\Actions\Post;

use App\Models\Post;
use App\Models\PostReact;

class UnreactPost
{
    public function execute($request, $id)
    {
        return PostReact::where('post_id', $id)->where('user_id', $request->user()->id)->delete();
    }
}