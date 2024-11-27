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
        Schema::table('job_seeker', function (Blueprint $table) {
            $table->renameColumn('job_id', 'skill_id');
        });
        Schema::rename('job_seeker', 'seeker_skill');
        Schema::rename('jobs', 'skills');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('seeker_skill', 'job_seeker');
        Schema::rename('skills', 'jobs');
        Schema::table('job_seeker', function (Blueprint $table) {
            $table->renameColumn('skill_id', 'job_id');
        });
    }
};
