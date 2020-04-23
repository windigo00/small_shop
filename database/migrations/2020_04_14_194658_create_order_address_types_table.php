<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Model\Order\Address\Type;

class CreateOrderAddressTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_address_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label');
        });

        foreach (Type::ADDRESS_TYPES as $idx => $type) {
            Type::query()->insert([
                'name'  => $type,
                'label' => Type::ADDRESS_LABELS[$idx]
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_address_types');
    }
}
