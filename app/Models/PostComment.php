<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'content',
        'user_id',
        'post_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function postCommentReacts()
    {
        return $this->hasMany(PostCommentReact::class);
    }

    public function postCommentUpvotes()
    {
        return $this->hasMany(PostCommentReact::class)->where('type', 'upvote');
    }

    public function postCommentDownvotes()
    {
        return $this->hasMany(PostCommentReact::class)->where('type', 'downvote');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
