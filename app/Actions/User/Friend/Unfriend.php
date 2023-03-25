<?php

namespace App\Actions\User\Friend;

use App\Models\Friend;
use App\Models\User;

class Unfriend
{
    /**
     * Accept a friend request
     */
    public function execute($id)
    {
        $friend = Friend::where('user_id', auth()->id())->where('friend_id', $id)->first();

        if (!$friend) {
            $friend = Friend::where('user_id', $id)->where('friend_id', auth()->id())->first();
        }

        return $friend->delete();

    }
}