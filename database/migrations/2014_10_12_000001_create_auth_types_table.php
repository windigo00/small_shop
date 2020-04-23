<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Model\Auth\Type;

class CreateAuthTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label');
        });

        foreach (Type::AUTH_TYPES as $idx => $type) {
            Type::query()->insert([
                'name'  => $type,
                'label' => Type::AUTH_LABELS[$idx]
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
        Schema::dropIfExists('auth_types');
    }
}
