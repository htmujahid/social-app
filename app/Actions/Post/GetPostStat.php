<?php

namespace App\Actions\Post;

use App\Models\PostStat;

class GetPostStat
{
    public function execute($id)
    {
        $postStat = PostStat::where('post_id', $id)->count();
        return $postStat;
    }
}