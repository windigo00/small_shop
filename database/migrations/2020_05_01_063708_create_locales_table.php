<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locales', function (Blueprint $table) {
            $table->id();
            $table->text('key');
        });
        Schema::create('locale_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        $locales = config('app.enabled_locale');
        $locale_codes = config('app.locale_codes');
        foreach($locales as $locale) {
            Schema::create('locales_'.$locale, function (Blueprint $table) {
                $table->id();
                $table->text('value');
                $table->unsignedBigInteger('group_id');
                $table->unsignedBigInteger('key_id');
                $table->foreign('group_id')->references('id')->on('locale_groups');
                $table->foreign('key_id')->references('id')->on('locales');
            });
        }
//        throw new \Exception;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $locales = config('app.enabled_locale');
        foreach($locales as $locale) {
            Schema::dropIfExists('locales_'.$locale);
        }
        Schema::dropIfExists('locale_groups');
        Schema::dropIfExists('locales');
    }
}
