<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/
// user admin
Route::resources([
    'users' => 'Admin\UserController',
]);
