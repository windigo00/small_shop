<?php

use Illuminate\Support\Facades\Route;
use App\Model\User;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
|
*/

// home page
Route::get('/', 'HomeController@index')->name('home');




