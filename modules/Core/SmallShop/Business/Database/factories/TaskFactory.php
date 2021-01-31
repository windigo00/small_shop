<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Core\SmallShop\Business\Model\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'amount' => random_int(1,8),
        'date' => $faker->date(),
    ];
});
