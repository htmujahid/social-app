<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCommentReact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_comment_id',
        'type',
    ];

    
}
