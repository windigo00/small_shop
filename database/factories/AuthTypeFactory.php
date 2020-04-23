<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Auth\Type;
use Faker\Generator as Faker;

$factory->define(Type::class, function (Faker $faker) {
    $idx = random_int(0, count(Type::AUTH_LABELS));
    return [
        'name'  => Type::AUTH_TYPES[idx],
        'title' => Type::AUTH_LABELS[$idx]
    ];
});
