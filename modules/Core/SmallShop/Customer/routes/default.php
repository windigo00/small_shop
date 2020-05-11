<?php
use Illuminate\Support\Facades\Route;
use Modules\Core\SmallShop\Customer\Http\Controller\ProfileController;

Route::post('card/{card_number?}', 'CardController@check')->name('card.check');

//user detail
Route::get('profile/{user:name?}', function (ProfileController $ctrl, User $user = null) {
    if (!$user && Auth::user()) {
        $customer = Auth::user()->customer;
        if ($customer) {
            return $ctrl->index($customer);
        } else {
            return view('front.forbidden', ['message' => 'Go to db and create yourself a customer.']);
        }
    }
    if ($user) {
        return $ctrl->show($user->customer);
    }
});