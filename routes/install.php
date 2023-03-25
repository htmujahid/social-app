<?php

use App\Http\Controllers\Install\Requirements;
use Illuminate\Support\Facades\Route;

Route::get('/', [Requirements::class, 'index'])->name('requirements');