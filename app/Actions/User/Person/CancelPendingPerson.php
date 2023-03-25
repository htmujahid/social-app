<?php 

namespace App\Actions\User\Person;

use App\Models\Friend;

class CancelPendingPerson 
{
    public function execute(string $id)
    {
        return Friend::where('user_id', auth()->user()->id)->where('friend_id', $id)->delete();

    }
}