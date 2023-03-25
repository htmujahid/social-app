<?php

use App\Http\Controllers\Install\Requirements;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Install Routes
|--------------------------------------------------------------------------
|
| Here is where you can register routes related to installing configuration
| for your application. These routes are loaded by the RouteServiceProvider
| and all of them will be assigned to the "install" middleware group. All 
| of the routes and their names are prefixed with "install". Make something 
| great!
|   
*/

Route::get('/', [Requirements::class, 'index'])->name('requirements');