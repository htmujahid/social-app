<?php

namespace App\Http\Controllers\User;

use App\Actions\User\DeleteUser;
use App\Actions\User\GetUsers;
use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = (new GetUsers())->execute();
        
        return view('users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = (new DeleteUser())->execute($id);
        return redirect()->route('admin.users.index');
    }
}
