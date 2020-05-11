<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Order\Item;
use Faker\Generator as Faker;
use Modules\Core\SmallShop\Catalog\Model\Product;

$factory->define(Item::class, function (Faker $faker) {
    /* @var $product Product */
    $product = Product::all()->random()->first();
    $units = random_int(1, 5);
    return [
        'product_id' => $product->id,
        'unit_price' => $product->price,
        'units'      => $units,
        'price'      => $product->price * $units,
    ];
});
