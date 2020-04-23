<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Card;
use Faker\Generator as Faker;
use App\Model\Card\Type;

$factory->define(Card::class, function (Faker $faker) {
    return [
        'number'      => $faker->numerify('#####-#####'),
        'type_id'     => Type::all()->random(),
        'valid_to'    => now()
    ];
});
