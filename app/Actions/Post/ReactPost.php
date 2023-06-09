<?php

namespace App\Actions\Post;

use App\Models\Post;
use App\Models\PostReact;

class ReactPost
{
    public function execute($request, $id)
    {
        return PostReact::create(
            [
                'post_id' => $id,
                'user_id' => $request->user()->id,
                'type' => $request->input('type'),
            ]
        );
    }
}