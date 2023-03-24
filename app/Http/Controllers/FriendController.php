<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
            ->get();

        return view('users.friends', [
            'friends' => $friends,
        ]);
        
    }

    /**
     * Display a pending request of the resource.
     */
    public function pendingRequests()
    {
        $pending_requests = Friend::where('friend_id', auth()->id())
            ->whereNull('accepted')
            ->get();

        $friends = User::whereIn('id', $pending_requests->pluck('user_id'))
            ->get();

        return view('users.friends', [
            'friends' => $friends,
        ]);
    }

    /**
     * delete of the requested resource.
     */
    public function unfriend(string $id)
    {
        $friend = Friend::where('user_id', auth()->id())->where('friend_id', $id)->first();

        if (!$friend) {
            $friend = Friend::where('user_id', $id)->where('friend_id', auth()->id())->first();
        }

        $friend->delete();

        return redirect()->route('friends.index');
    }

    /**
     * accept of the resource.
     */
    public function acceptFriend(string $id)
    {
        $friend = Friend::where('user_id', $id)
            ->where('friend_id', auth()->id())
            ->first();

        $friend->accepted = now();

        $friend->save();

        return redirect()->route('friends.index');
    }

}
