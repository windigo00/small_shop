<?php
use Illuminate\Support\Facades\Route;
//product detail
Route::get('{product:seo_name}', 'ProductController@show')->name('product.detail');