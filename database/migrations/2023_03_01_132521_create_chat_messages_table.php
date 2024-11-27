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
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('chat_room_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->text('content');
            $table->enum('type', ['TEXT', 'IMAGE', 'AUDIO', 'FILE']);
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
        Schema::dropIfExists('chat_messages');
    }
};
