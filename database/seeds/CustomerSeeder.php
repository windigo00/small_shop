<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Model\User;
use App\Model\Customer;
use App\Model\Customer\Card as CustomerCard;
use App\Model\Customer\Address;
use App\Model\Card;
use App\Model\Auth\Type;
use App\Model\Auth\UserAuthType;

class CustomerSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void {
        /* @var $customerType Type  */
        $customerType = Type::query()->where('name', '=', Type::AUTH_TYPE_CUSTOMER)->first();

        factory(User::class, 5)
            ->create()
            ->each(function(User $u) use ($customerType) {

                UserAuthType::query()->insert([
                    'user_id' => $u->id,
                    'type_id' => $customerType->id
                ]);

                /* @var $c Customer */
                $c = factory(Customer::class)->make();
                $c->user()->associate($u);
                $c->save();
                factory(Address::class, 2)
                    ->make()
                    ->each(function(Address $address) use ($c) {
                        $c->addresses()->save($address);
                    });

//                $c->cards()->updateOrCreate(factory(Card::class, 3)->raw());

//                factory(Card::class, 3)
//                    ->create()
//                    ->each(function(Card $card) use ($c) {
//                        $c->cards()->attach($card);
//                    });

            });
    }

}
