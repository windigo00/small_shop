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

    // overview
    Route::get('/', function () {
        return redirect(route('admin.dashboard.index'));
    })->name('home');

    // user admin
    Route::resources([
        'dashboard' => 'DashboardController',
        'users' => 'UserController',
        'customers' => 'CustomerController',
        'products' => 'ProductController',
    ]);
    Route::prefix('sales')->name('sales.')->group(function () {
        Route::resources([
            // order admin
            'orders' => 'Sales\OrderController',
        ]);
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::post('print/{order:id}', 'Sales\OrderController@print')->name('print');
        });
    });


//    Route::resource('user', \App\Http\Controllers\User\UserController, [ 'only' => [ 'update', 'destroy' ] ]);

//    Route::prefix('customer')->group(function () {
//        Route::post('grid', function (Request $request, UserController $ctrl) {
//            return $ctrl->grid($request);
//        })->name('customer.grid');
//    });
});
