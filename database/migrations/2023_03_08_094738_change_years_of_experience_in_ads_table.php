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
            $table->dropColumn('years_of_experience');
        });
        Schema::table('ads', function (Blueprint $table) {
            $table->enum('years_of_experience', ['1-', '3-', '10-', '10+'])->default('1-')->after('marital_status');
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
            $table->dropColumn('years_of_experience');
        });
        Schema::table('ads', function (Blueprint $table) {
            $table->integer('years_of_experience')->unsigned()->default(0);
        });
    }
};
