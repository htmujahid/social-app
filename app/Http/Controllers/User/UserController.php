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
    public function index()
    {
        $users = (new GetUsers())->execute();
        
        return Inertia::render('Users/Users', [
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
