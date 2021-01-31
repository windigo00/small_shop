<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Core\SmallShop\Business\Model\Contractor;
use Modules\Core\SmallShop\User\Model\User;
use Faker\Generator as Faker;

$factory->define(Contractor::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'ico' => $faker->ean13,
        'dic' => $faker->isbn13,
        'owner' => User::all()->random()->first(),
        'date' => $faker->date(),
    ];
});
