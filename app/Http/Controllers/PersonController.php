<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;

class PersonController extends Controller
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
            ->get();

        $friends_id = [];

        foreach ($current_friends as $friend) {
            if ($friend->user_id == auth()->id()) {
                $friends_id[] = $friend->friend_id;
            } else {
                $friends_id[] = $friend->user_id;
            }
        }
        
        $persons = User::whereNotIn('id', $friends_id)->where('id', '!=', auth()->user()->id)->get();

        return view('users.persons',[
            'persons' => $persons,
        ]);
    }

    /**
     * Add a friend to the user.
     */
    public function addfriend(string $id)
    {
        Friend::create([
            'user_id' => auth()->user()->id,
            'friend_id' => $id,
        ]);
        return redirect()->route('persons.index');
    }

    /**
     * Show the pending friends.
     */
    public function pending()
    {

        $friends_id = Friend::where('user_id', auth()->user()->id)->whereNull('accepted')->pluck('friend_id');

        $persons = User::whereIn('id', $friends_id)->get();

        return view('users.persons',[
            'persons' => $persons,
        ]);
    }

    /**
     * delete the requested resource
     */
    public function cancel(string $id)
    {
        Friend::where('user_id', auth()->user()->id)->where('friend_id', $id)->delete();
        return redirect()->route('persons.index');

    }
}
