<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Currency;
use Faker\Generator as Faker;

$factory->define(Currency::class, function (Faker $faker) {
    return [
        'code' => $faker->currencyCode,
        'title' => $faker->country,
        'sign' => $faker->randomAscii,
        'enabled' =>  true
    ];
});
