<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

Route::resources([
    // order admin
    'orders' => 'OrderController',
    'invoices' => 'InvoiceController',
]);
Route::prefix('orders')->name('orders.')->group(function () {
    Route::post('print/{order:id}', 'OrderController@print')->name('print');
});
Route::prefix('invoices')->name('invoices.')->group(function () {
    Route::post('print/{invoice:id}', 'InvoiceController@print')->name('print');
});