<?php

namespace App\Actions\User\Friend;

use App\Models\Friend;
use App\Models\User;

class AcceptFriend
{
    /**
     * Accept a friend request
     */
    public function execute($id)
    {
        $friend = Friend::where('user_id', $id)
        ->where('friend_id', auth()->id())
        ->first();

        $friend->accepted = now();

        return $friend->save();
    }
}