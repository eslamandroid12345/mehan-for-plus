<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seekers', function (Blueprint $table) {
            $table->bigInteger('nationality_id')->nullable()->unsigned()->change();
            $table->bigInteger('city_id')->nullable()->unsigned()->change();
            $table->string('religion')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seekers', function (Blueprint $table) {
            $table->bigInteger('nationality_id')->nullable(false)->unsigned()->change();
            $table->bigInteger('city_id')->nullable(false)->unsigned()->change();
            $table->string('religion')->nullable(false)->change();
        });
    }
};
