<?php

namespace App\Http\Controllers\User;

use App\Actions\User\Person\CancelPendingPerson;
use App\Actions\User\Person\AddPerson;
use App\Actions\User\Person\GetPendingPersons;
use App\Actions\User\Person\GetPersons;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $persons = (new GetPersons())->execute();

        return view('users.persons',[
            'persons' => $persons,
        ]);
    }

    /**
     * Add a friend to the user.
     */
    public function addfriend(string $id)
    {
        $friend = (new AddPerson())->execute($id);

        return $friend;
    }

    /**
     * Show the pending friends.
     */
    public function pending()
    {
        $persons = (new GetPendingPersons())->execute();

        return view('users.persons',[
            'persons' => $persons,
        ]);
    }

    /**
     * delete the requested resource
     */
    public function cancel(string $id)
    {
        $friend = (new CancelPendingPerson())->execute($id);

        return $friend;
    }
}
