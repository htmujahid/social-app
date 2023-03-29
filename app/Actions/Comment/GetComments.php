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
                $comments = PostComment::where('user_id', $query['user_id'])->with('user', 'post', 'postCommentUpvotes', 'postCommentDownvotes')->get();
            } else {
                $comments = PostComment::with('user', 'post', 'postCommentUpvotes', 'postCommentDownvotes')->get();
            }
        } else {
            if (isset($query['user_id'])) {
                $comments = PostComment::where('user_id', $query['user_id'])->where('post_id', $id)->with('user', 'post', 'postCommentUpvotes', 'postCommentDownvotes')->get();
            } else {
                $comments = PostComment::where('post_id', $id)->with('user', 'post', 'postCommentUpvotes', 'postCommentDownvotes')->get();
            }
        }
        return $comments;
    }
}