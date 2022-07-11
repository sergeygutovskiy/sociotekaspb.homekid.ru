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
        Schema::create('job_primary_infos', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('purpose');
            $table->string('objectives');
            $table->string('annotation');
            $table->string('main_qualitative_results');
            $table->string('photo_file_path');
            $table->string('brief_description_of_resources');
            $table->string('best_practice');
            $table->string('social_outcome');
            $table->string('video_link');

            $table->unsignedBigInteger('implementation_for_citizen_id');
            $table->foreign('implementation_for_citizen_id')->references('id')->on('dictionary_categories');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('dictionary_categories');

            $table->unsignedBigInteger('form_of_social_service_id');
            $table->foreign('form_of_social_service_id')->references('id')->on('dictionary_categories');

            $table->unsignedBigInteger('engagement_of_volunteers_id');
            $table->foreign('engagement_of_volunteers_id')->references('id')->on('dictionary_categories');

            $table->json('target_group_ids');

            $table->boolean('is_possibility_in_remote');
            $table->boolean('is_innovation_site');
            $table->boolean('is_has_expert_opinion');
            $table->boolean('is_has_expert_review');
            $table->boolean('is_has_expert_feedback');

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
        Schema::dropIfExists('jobs_primary_info');
    }
};
