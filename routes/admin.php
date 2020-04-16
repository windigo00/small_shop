<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/
Route::prefix('admin')->group(function () {

    // overview
    Route::get('/', function () {
        return view('admin.index');
    });

    // user admin
    Route::resources([
        'users' => App\Http\Controllers\Admin\UserController::class,
        'customers' => App\Http\Controllers\Admin\CustomerController::class,
    ]);
    Route::prefix('sales')->group(function () {
        Route::resources([
            // order admin
            'orders' => App\Http\Controllers\Admin\Sales\OrderController::class,
        ]);
    });


//    Route::resource('user', \App\Http\Controllers\User\UserController, [ 'only' => [ 'update', 'destroy' ] ]);

    Route::prefix('customer')->group(function (Router $router) {
        $router->post('grid', function (Request $request, UserController $ctrl) {
            return $ctrl->grid($request);
        })->name('customer.grid');
    });
});
