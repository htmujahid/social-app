<?php

namespace App\Actions\User\Friend;

use App\Models\Friend;
use App\Models\User;

class GetFriends
{
    /**
     * Accept a friend request
     */
    public function execute()
    {
        $current_friends = Friend::where(function ($query) {
            $query->where('user_id', auth()->id())
                  ->orWhere('friend_id', auth()->id());
            })
            ->whereNotNull('accepted')
            ->get();

        $friends_id = [];

        foreach ($current_friends as $friend) {
            if ($friend->user_id == auth()->id()) {
                $friends_id[] = $friend->friend_id;
            } else {
                $friends_id[] = $friend->user_id;
            }
        }

        $friends = User::whereIn('id', $friends_id)
            ->with('userMedia')
            ->get();

        return $friends;
    }
}