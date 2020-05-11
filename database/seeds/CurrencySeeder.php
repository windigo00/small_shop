<?php

use Illuminate\Database\Seeder;
use App\Model\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Currency::class)->create([
            'code' => 'CZK',
            'title' => 'Česká koruna',
            'sign' => '%d Kč',
            'enabled' =>  true
        ]);
    }
}
