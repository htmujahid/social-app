<?php

namespace App\Http\Controllers\User;

use App\Actions\User\Friend\AcceptFriend;
use App\Actions\User\Friend\GetFriends;
use App\Actions\User\Friend\GetPendingRequests;
use App\Actions\User\Friend\Unfriend;
use App\Models\Friend;
use App\Http\Controllers\Controller;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $friends = (new GetFriends())->execute();

        return view('users.friends', [
            'friends' => $friends,
        ]);
        
    }

    /**
     * Display a pending request of the resource.
     */
    public function pendingRequests()
    {
        $pending_friend_requests = (new GetPendingRequests())->execute();

        return view('users.friends', [
            'friends' => $pending_friend_requests,
        ]);
    }

    /**
     * delete of the requested resource.
     */
    public function unfriend(string $id)
    {
        $friend = (new Unfriend())->execute($id);

        return $friend;
    }

    /**
     * accept of the resource.
     */
    public function acceptFriend(string $id)
    {
        $friend = (new AcceptFriend())->execute($id);

        return $friend;
    }

}
