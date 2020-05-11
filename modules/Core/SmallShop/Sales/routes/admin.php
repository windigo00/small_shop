<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

Route::resources([
    // order admin
    'orders' => 'OrderController',
]);
Route::prefix('orders')->name('orders.')->group(function () {
    Route::post('print/{order:id}', 'OrderController@print')->name('print');
});