<?php

namespace App\Http\Controllers\User;

use App\Actions\User\Friend\AcceptFriend;
use App\Actions\User\Friend\GetFriends;
use App\Actions\User\Friend\GetUnrespondedRequests;
use App\Actions\User\Friend\Unfriend;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $friends = (new GetFriends())->execute();
        $unresponded_requests = (new GetUnrespondedRequests())->execute();

        return Inertia::render('Users/Friends', [
            'friends' => $friends,
            'unresponded_requests' => $unresponded_requests,
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
