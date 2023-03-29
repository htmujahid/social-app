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
        $users = User::with(['posts', 'postComments'])->get();
        
        return $users;
    }
}