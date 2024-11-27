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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->unsigned();
            $table->bigInteger('seeker_id')->unsigned();

            $table->foreign('company_id')->references('id')->on('companies')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('seeker_id')->references('id')->on('seekers')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('favorites', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['seeker_id']);
        });
        Schema::dropIfExists('favorites');
    }
};
