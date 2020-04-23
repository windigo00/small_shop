<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Model\Card\Type;

class CreateCardTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
        });

        foreach (Type::TYPE_NAMES as $idx => $type) {
            Type::query()->insert([
                'name'  => $type,
                'title' => Type::TYPE_LABELS[$idx]
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
        Schema::dropIfExists('card_types');
    }
}
