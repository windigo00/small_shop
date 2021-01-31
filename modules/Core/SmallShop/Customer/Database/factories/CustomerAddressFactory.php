<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Customer\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {

    $countries = app('locale.country_list')->list(app()->getLocale());
    $key_idx = random_int(0, count($countries)-1);
    $key = array_keys($countries)[$key_idx];

    return [
        'street'    => $faker->streetName,
        'street_nr' => $faker->numberBetween(),
        'city'      => $faker->city,
        'zip'       => $faker->postcode,
        'country'   => $key,
    ];
});
