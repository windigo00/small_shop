<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/
// overview
Route::get('/', function () {
    return redirect(route('admin.dashboard.index'));
})->name('home');

// user admin
Route::resources([
    'dashboard' => 'Admin\DashboardController',
]);