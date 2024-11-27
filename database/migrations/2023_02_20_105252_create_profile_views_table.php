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
        Schema::create('profile_views', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->unsigned();
            $table->bigInteger('ad_id')->unsigned();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('ad_id')->references('id')->on('ads')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile_views', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['ad_id']);
        });
        Schema::dropIfExists('profile_views');
    }
};
