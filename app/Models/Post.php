<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'user_id'
    ];

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the comments for the post.
     */

    public function postComments()
    {
        return $this->hasMany(PostComment::class);
    }
    
    /**
     * Get the media for the post.
     */
    public function postMedia()
    {
        return $this->hasMany(PostMedia::class);
    }

    /**
     * Get the reactions for the post.
     */
    public function postReacts()
    {
        return $this->hasMany(PostReact::class);
    }

    /**
     * Get the stats for the post.
     */
    public function postStats()
    {
        return $this->hasMany(PostStat::class);
    }

}
