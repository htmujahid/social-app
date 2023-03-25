<?php

namespace App\Actions\Post;

use App\Models\Post;
use App\Models\PostMedia;

class CreatePost
{
    public function execute($request)
    {
        $post = Post::create(
            [
                'content' => $request->input('content'),
                'user_id' => $request->user()->id,
            ]
        );

        if ($request->hasFile('media')) {
            $files = $request->file('media');

            foreach ($files as $file) {
                $path = $file->store('posts', 'public');

                PostMedia::create(
                    [
                        'post_id' => $post->id,
                        'path' => $path,
                    ]
                );
            }
        }
    }
}