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
        Schema::create('job_seeker', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('seeker_id')->unsigned();
            $table->bigInteger('job_id')->unsigned();

            $table->foreign('seeker_id')->references('id')->on('seekers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('job_id')->references('id')->on('jobs')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_seeker', function (Blueprint $table) {
            $table->dropForeign(['seeker_id']);
            $table->dropForeign(['job_id']);
        });
        Schema::dropIfExists('job_seeker');
    }
};
