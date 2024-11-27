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
        Schema::create('seekers', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('gender');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('nationality_id')->unsigned();
            $table->boolean('is_resident');
            $table->string('residency_number')->nullable();
            $table->boolean('is_worked_before_in_ksa')->nullable();
            $table->timestamp('residency_expiration')->nullable();
            $table->string('religion');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
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
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('seekers');
    }
};
