<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Order;
use App\Model\Customer;
use App\Model\Order\Status;
use App\Model\Order\Item;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    /* @var $customer Customer */
    $customer = Customer::all()->random()->first();

    return [
        'order_nr' => $faker->numerify('##########'),
        'customer_id' => $customer->id,
        'status_id' => Status::query()->where('name', '=', Status::STATUS_NAME_NEW)->first()->id,
        'card_id' => null,
        'price' => 0,
    ];
});
