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
        Schema::create('chat_rooms_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('chat_room_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('chat_room_id')->references('id')->on('chat_rooms')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chat_rooms_users', function (Blueprint $table) {
            $table->dropForeign(['chat_room_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('chat_rooms_users');
    }
};
