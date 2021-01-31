<?php
use Illuminate\Support\Facades\Route;
// language
Route::get('locale/set/{locale}', 'ConfigController@setLocale')->name('locale.set');