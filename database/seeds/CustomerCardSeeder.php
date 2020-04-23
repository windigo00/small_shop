<?php

use Illuminate\Database\Seeder;
use App\Model\Customer\Card as CCard;
use App\Model\Card;
use App\Model\Customer;

class CustomerCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::all()
            ->random(5)
            ->each(function(Customer $c) {
                factory(CCard::class)->create([
                    'card_id' => factory(Card::class)->create()->id,
                    'customer_id' => $c->id
                ]);
            });
//        factory(User::class, 5)
//            ->create()
//            ->each(function(User $u) {
//                /* @var $c Customer */
//                $c = factory(Customer::class)->make();
//                $c->user()->associate($u);
//                $c->save();
//                factory(Address::class, 2)
//                    ->make()
//                    ->each(function(Address $address) use ($c) {
//                        $c->addresses()->save($address);
//                    });
    }
}
