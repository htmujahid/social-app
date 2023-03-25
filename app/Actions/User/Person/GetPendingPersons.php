<?php

namespace App\Actions\User\Person;

use App\Models\Friend;
use App\Models\User;

class GetPendingPersons 
{
    public function execute()
    {
        $friends_id = Friend::where('user_id', auth()->user()->id)->whereNull('accepted')->pluck('friend_id');

        $persons = User::whereIn('id', $friends_id)->with('userMedia')->get();

        return $persons;
    }
}