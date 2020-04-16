<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call([
            CardSeeder::class,
            CustomerSeeder::class,
            CustomerAddressSeeder::class,
            CustomerCardSeeder::class,
            CustomerCardTypeSeeder::class,
            ProductSeeder::class,
            OrderSeeder::class,
        ]);
    }

}
