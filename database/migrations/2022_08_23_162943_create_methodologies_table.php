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
        Schema::create('methodologies', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')->references('id')->on('jobs');

            $table->unsignedBigInteger('direction_id');
            $table->foreign('direction_id')->references('id')->on('dictionaries');

            $table->unsignedBigInteger('prevalence_id');
            $table->foreign('prevalence_id')->references('id')->on('dictionaries');

            $table->unsignedBigInteger('activity_organization_form_id');
            $table->foreign('activity_organization_form_id')->references('id')->on('dictionaries');

            $table->unsignedBigInteger('application_period_id');
            $table->foreign('application_period_id')->references('id')->on('dictionaries');

            $table->text('authors')->nullable();
            $table->text('publication_link')->nullable();
            
            $table->text('effectiveness_study')->nullable();
            $table->string('effectiveness_study_link')->nullable();
            
            $table->text('realized_cycles');
            $table->text('cycle_duration');

            $table->json('public_work_ids');

            $table->json('service_type_ids');
            $table->json('service_name_ids');

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
        Schema::dropIfExists('methodologies');
    }
};
