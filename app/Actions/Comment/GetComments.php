<?php 

namespace App\Actions\Comment;

use App\Models\PostComment;
use Illuminate\Database\Eloquent\Collection;

class GetComments
{
    public function execute($request, $id): Collection
    {
        $query = $request->query();

        if ($id == '_') {
            if (isset($query['user_id'])) {
                $comments = PostComment::where('user_id', $query['user_id'])->get();
            } else {
                $comments = PostComment::all();
            }
        } else {
            if (isset($query['user_id'])) {
                $comments = PostComment::where('user_id', $query['user_id'])->where('post_id', $id)->get();
            } else {
                $comments = PostComment::where('post_id', $id)->get();
            }
        }
        return $comments;
    }
}