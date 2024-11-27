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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('seeker_id')->unsigned();
            $table->tinyInteger('work_hours_type')->unsigned()->comment('0 = Full Time, 1 = Part Time');
            $table->bigInteger('city_of_residence')->unsigned()->nullable();
            $table->tinyInteger('marital_status')->unsigned()->comment('0 = Single, 1 = Married, 2 = Divorced, 3 = Widowed');
            $table->integer('years_of_experience')->unsigned();
            $table->boolean('is_active')->default(false);
            $table->timestamp('expiration_date');
            $table->bigInteger('latest_transaction_id')->unsigned();
            $table->timestamps();

            $table->foreign('seeker_id')->references('id')->on('seekers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('latest_transaction_id')->references('id')->on('transactions')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropForeign(['seeker_id']);
            $table->dropForeign(['latest_transaction_id']);
        });
        Schema::dropIfExists('ads');
    }
};
