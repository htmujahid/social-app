<?php

namespace App\Http\Controllers;

use App\Actions\Summary;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    
    public function index(Summary $summary)
    {
        $summary = $summary->execute();        
        return Inertia::render('Dashboard',$summary);
    }


}
