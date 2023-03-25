<?php

namespace App\Actions\User\Friend;

use App\Models\Friend;
use App\Models\User;

class GetPendingRequests
{
    /**
     * Accept a friend request
     */
    public function execute()
    {
        $pending_requests = Friend::where('friend_id', auth()->id())
        ->whereNull('accepted')
        ->get();

        $pending_friend_requests = User::whereIn('id', $pending_requests->pluck('user_id'))
        ->get();

        return $pending_friend_requests;
    }
}