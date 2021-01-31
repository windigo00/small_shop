<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/
Route::resources([
    'settings' => 'Admin\ConfigController',
    'locale'   => 'Admin\LocaleController',
]);