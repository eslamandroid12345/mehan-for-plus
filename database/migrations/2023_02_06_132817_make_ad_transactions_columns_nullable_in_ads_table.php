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
        Schema::table('ads', function (Blueprint $table) {
//            $table->timestamp('expiration_date')->nullable()->change();
            $table->bigInteger('latest_transaction_id')->unsigned()->nullable()->change();
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
//            $table->timestamp('expiration_date')->nullable(false)->change();
            $table->bigInteger('latest_transaction_id')->unsigned()->nullable(false)->change();
        });
    }
};
