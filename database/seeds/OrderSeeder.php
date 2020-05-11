<?php

use Illuminate\Database\Seeder;
use App\Model\Order;
use App\Model\Order\Item;
use App\Model\Customer;
use App\Model\Currency;
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
        /* @var $customer Currency  */
        $currency = Currency::query()->where('code', '=', 'CZK')->first();

        factory(Order::class, 200)
            ->make()
            ->each(function (Order $o) use ($customers, $currency) {
                /* @var $c Customer */
                $c = $customers->random(1)->first();
                $o->customer_id = $c->id;
                $o->currency_id = $currency->id;
                $o->save();

//                $sum = 0;
                $items = factory(Item::class, 2)->make();//->each(function (Item $item) use ($o) {
                $o->items()->saveMany($items);
//                    $sum += $item->price;
//                });
                $o->price = $o->items->sum('price');
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
