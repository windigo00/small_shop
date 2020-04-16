<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Customer\Card;
use Faker\Generator as Faker;

$factory->define(Card::class, function (Faker $faker) {
    return [
        'number'      => $faker->numerify('####-####'),
        'type_id'     => 1,
        'customer_id' => null,
        'valid_to'    => now()
    ];
});
