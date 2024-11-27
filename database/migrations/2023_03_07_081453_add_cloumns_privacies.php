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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_phone_public')->nullable()->after('phone');
        });
        Schema::table('seekers', function (Blueprint $table) {
            $table->boolean('is_residency_number_public')->nullable()->after('residency_number');
            $table->boolean('is_residency_expiration_public')->nullable()->after('residency_expiration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_phone_public');
        });
        Schema::table('seekers', function (Blueprint $table) {
            $table->dropColumn('is_residency_number_public');
            $table->dropColumn('is_residency_expiration_public');
        });
    }
};
