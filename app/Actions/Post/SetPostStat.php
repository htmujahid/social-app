<?php

namespace App\Actions\Post;

use App\Models\PostStat;

class SetPostStat
{
    public function execute($request, $id)
    {
        return PostStat::create(
            [
                'post_id' => $id,
                'user_id' => $request->user()->id,
            ]
        );
    }
}