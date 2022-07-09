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
        Schema::create('job_experiences', function (Blueprint $table) {
            $table->id();

            $table->json('results_in_district_and_media')->nullable();
            $table->json('results_on_television')->nullable();
            $table->json('results_at_various_levels_events')->nullable();
            $table->json('results_on_website_of_institution')->nullable();
            $table->json('results_on_radio')->nullable();
            $table->json('results_in_article')->nullable();
            $table->json('conducting_master_classes')->nullable();

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
        Schema::dropIfExists('jobs_experience');
    }
};
