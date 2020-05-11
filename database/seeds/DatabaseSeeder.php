<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CardSeeder::class,
            CurrencySeeder::class,
            CustomerSeeder::class,
//            CustomerAddressSeeder::class,
            CustomerCardSeeder::class,
            \Modules\Core\SmallShop\Catalog\Database\Seeds\ProductSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
