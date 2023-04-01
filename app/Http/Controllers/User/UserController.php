<?php

namespace App\Http\Controllers\User;

use App\Actions\User\DeleteUser;
use App\Actions\User\GetUsers;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetUsers $getUsers)
    {
        $users = $getUsers->execute();
        
        return Inertia::render('Users/Users', [
            'users' => $users,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DeleteUser $deleteUser)
    {
        $user = $deleteUser->execute($id);
        
        return redirect()->route('admin.users.index');
    }
}
