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
        Schema::create('edu_programs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')->references('id')->on('jobs');

            $table->unsignedBigInteger('direction_id');
            $table->foreign('direction_id')->references('id')->on('dictionaries');

            $table->unsignedBigInteger('conducting_classes_form_id');
            $table->foreign('conducting_classes_form_id')->references('id')->on('dictionaries');

            $table->text('dates_and_mode_of_study');

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
        Schema::dropIfExists('edu_programs');
    }
};
