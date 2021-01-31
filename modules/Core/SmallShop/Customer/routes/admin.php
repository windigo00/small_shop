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
    'customers' => 'Admin\CustomerController',
]);
//Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
//
//});