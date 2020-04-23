<?php

use Illuminate\Database\Seeder;
use App\Model\Order;
use App\Model\Order\Item;
use App\Model\Customer;
use App\Model\Customer\Address as CAddress;
use App\Model\Order\Address as OAddress;
use App\Model\Order\Address\Type as OAddressType;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* @var $customer Customer  */
        $customers = Customer::all();


        factory(Order::class, 20)
            ->create()
            ->each(function(Order $o) use ($customers) {
                $sum = 0;
                /* @var $c Customer */
                $c = $customers->random(1)->first();
                factory(Item::class, 2)
                    ->make()
                    ->each(function(Item $item) use ($o, $sum) {
                        $sum += $item->price;
                        $o->items()->save($item);
                    });
                $o->price = $sum;
                $o->customer_id = $c->id;
                $o->save();

                factory(OAddress::class)->create([
                    'order_id' => $o->id,
                    'address_id' => $c->addresses[0]->id,
                    'address_type_id' => OAddressType::query()->where('name', '=', OAddressType::ADDRESS_TYPE_INVOICE)->first()->id
                ]);
                factory(OAddress::class)->create([
                    'order_id' => $o->id,
                    'address_id' => $c->addresses[0]->id,
                    'address_type_id' => OAddressType::query()->where('name', '=', OAddressType::ADDRESS_TYPE_DELIVERY)->first()->id
                ]);


            });
    }
}
