<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Model\User;
use App\Model\Customer;

class CustomerSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void {
        factory(User::class, 5)
                ->create()
                ->each(function(User $u) {
                    factory(Customer::class)->make()->user()->associate($u)->save();
                });
    }

}
