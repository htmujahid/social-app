<?php

namespace App\Actions\User;

use App\Models\User;

class GetUsers
{
    /**
     * Get users
     */
    public function execute()
    {  
        $users = User::with(['posts' =>
        function ($query) {
            $query->with('postComments');
        } ])->get();
        
        return $users;
    }
}