<?php

namespace App\Http\Controllers\User;

use App\Actions\User\Person\CancelPendingPerson;
use App\Actions\User\Person\AddPerson;
use App\Actions\User\Person\GetPendingPersons;
use App\Actions\User\Person\GetPersons;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $persons = (new GetPersons())->execute();
        $pending_persons = (new GetPendingPersons())->execute();
        return Inertia::render('Users/Persons',[
            'persons' => $persons,
            'pending_persons' => $pending_persons,
        ]);
    }

    /**
     * Add a friend to the user.
     */
    public function addfriend(string $id)
    {
        $friend = (new AddPerson())->execute($id);

        return Redirect::to('/persons');
    }

    /**
     * delete the requested resource
     */
    public function cancel(string $id)
    {
        $friend = (new CancelPendingPerson())->execute($id);

        return Redirect::to('/persons');
    }
}
