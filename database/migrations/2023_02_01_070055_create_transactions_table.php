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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('seeker_id')->unsigned();
            $table->float('amount')->unsigned();
            $table->string('reference')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->softDeletes();
            $table->timestamps();

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
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['seeker_id']);
        });
        Schema::dropIfExists('transactions');
    }
};
