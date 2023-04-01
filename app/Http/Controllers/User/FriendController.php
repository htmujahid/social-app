<?php

namespace App\Http\Controllers\User;

use App\Actions\User\Friend\AcceptFriend;
use App\Actions\User\Friend\GetFriends;
use App\Actions\User\Friend\GetUnrespondedRequests;
use App\Actions\User\Friend\Unfriend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetFriends $getFriends, GetUnrespondedRequests $getUnrespondedRequests)
    {
        $friends = $getFriends->execute();
        $unresponded_requests = $getUnrespondedRequests->execute();

        return Inertia::render('Users/Friends', [
            'friends' => $friends,
            'unresponded_requests' => $unresponded_requests,
        ]);
        
    }

    /**

     * delete of the requested resource.
     */
    public function unfriend(string $id, Unfriend $unfriend)
    {
        $friend = $unfriend->execute($id);

        return Redirect::to('/friends');
    }

    /**
     * accept of the resource.
     */
    public function acceptFriend(string $id, AcceptFriend $acceptFriend)
    {
        $friend = $acceptFriend->execute($id);

        return Redirect::to('/friends');
    }

}
