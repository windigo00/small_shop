<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Core\SmallShop\Catalog\Model\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'seo_name' => Str::random(),
        'price' => random_int(10, 1000) / 100.0,
    ];
});
