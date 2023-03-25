<?php

namespace App\Actions\User\Person;

use App\Models\Friend;
use App\Models\User;

class GetPersons
{
    public function execute()
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
        
        $persons = User::whereNotIn('id', $friends_id)->where('id', '!=', auth()->user()->id)->with('userMedia')->get();

        return $persons;
    }
}