<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'first_name' =>  $faker->firstName,
        'last_name'=> $faker->lastName,
        'registered_at' => now(),
        'phone' => $faker->phoneNumber
    ];
});
