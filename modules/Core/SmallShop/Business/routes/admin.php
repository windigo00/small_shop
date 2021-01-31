<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/
Route::resources([
    'invoices' => 'InvoiceController',
    // 'tasks' => 'TaskController',
]);

Route::prefix('tasks')->name('tasks.')->group(function () {
    Route::get('/', 'TaskController@index')->name('index');
    Route::get('hint', 'TaskController@hint')->name('hint');
    Route::get('{current?}', 'TaskController@show')->name('show');
    Route::post('{current?}', 'TaskController@list')->name('list');
    Route::put('store', 'TaskController@store')->name('store');
    Route::get('export/{current}/xls', 'TaskController@exportXls')->name('exportXls');
    Route::get('export/{current}/pdf', 'TaskController@exportPdf')->name('exportPdf');
});
Route::prefix('contracts')->name('contracts.')->group(function () {
    Route::resources([
        'contractors' => 'ContractorController',
    ]);
});