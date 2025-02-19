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
            $table->bigInteger('city_id')->unsigned()->after('nationality_id');

            $table->foreign('city_id')->references('id')->on('cities')->cascadeOnUpdate()->cascadeOnDelete();
        });
        Schema::table('ads', function (Blueprint $table) {
            $table->dropForeign(['city_of_residence']);
            $table->dropColumn('city_of_residence');
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
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
        });
        Schema::table('ads', function (Blueprint $table) {
            $table->bigInteger('city_of_residence')->unsigned()->nullable();
            
            $table->foreign('city_of_residence')->references('id')->on('cities')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }
};
