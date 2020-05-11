<?php
// language
Route::get('locale/set/{locale}', 'ConfigController@setLocale')->name('locale.set');