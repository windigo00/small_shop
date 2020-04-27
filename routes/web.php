<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CardController;
use App\Model\User;
use App\Model\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
|
*/

// home page
Route::get('/', 'HomeController@index')->name('home');

Route::any('forbidden', function () {
    return view('front.forbidden');
})->name('forbidden');

Auth::routes();

//user detail
Route::prefix('profile')->group(function () {
    Route::get('/{user:name?}', function (ProfileController $ctrl, User $user = null) {
        if (!$user && Auth::user()) {
            return $ctrl->index(Auth::user()->customer);
        }
        if ($user) {
            return $ctrl->show($user->customer);
        }
    });
});

Route::post('card/{card_number?}', 'CardController@check')->name('card.check');
//product detail
Route::get('{product:seo_name}', function (Product $product, ProductController $ctrl) {
    return $ctrl->show($product);
});
