<?php

use Illuminate\Support\Facades\Route;

//sleep(5);
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/
Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {

    


//    Route::resource('user', \App\Http\Controllers\User\UserController, [ 'only' => [ 'update', 'destroy' ] ]);

//    Route::prefix('customer')->group(function () {
//        Route::post('grid', function (Request $request, UserController $ctrl) {
//            return $ctrl->grid($request);
//        })->name('customer.grid');
//    });
});

