<?php

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