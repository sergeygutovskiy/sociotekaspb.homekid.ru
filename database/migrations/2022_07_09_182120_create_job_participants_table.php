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
        Schema::create('job_participants', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')->references('id')->on('jobs');

            $table->integer('total_number_of_participants')->unsigned();
            $table->integer('number_of_families')->unsigned();
            $table->integer('number_of_children')->unsigned();
            $table->integer('number_of_men')->unsigned();
            $table->integer('number_of_women')->unsigned();

            $table->integer('reporting_period_year')->unsigned();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs_participants');
    }
};
