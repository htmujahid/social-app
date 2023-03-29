<?php

namespace App\Http\Controllers;

use App\Actions\Summary;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    
    public function index()
    {
        $summary = (new Summary())->execute(auth()->user());
        
        return Inertia::render('Dashboard',$summary);
    }


}
