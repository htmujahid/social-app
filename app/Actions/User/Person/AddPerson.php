<?php

namespace App\Actions\User\Person;

use App\Models\Friend;

class AddPerson 
{
    public function execute(string $id)
    {
        return Friend::create([
            'user_id' => auth()->user()->id,
            'friend_id' => $id,
        ]);
    }
}

