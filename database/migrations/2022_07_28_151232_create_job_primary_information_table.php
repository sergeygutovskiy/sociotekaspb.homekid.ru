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
        Schema::create('job_primary_information', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('annotation');
            $table->text('objectives');
            $table->text('purpose');

            $table->unsignedBigInteger('payment_method_id');
            $table->foreign('payment_method_id')->references('id')->on('dictionaries');

            $table->json('partnership')->nullable();

            $table->unsignedBigInteger('volunteer_id');
            $table->foreign('volunteer_id')->references('id')->on('dictionaries');

            $table->json('needy_category_ids');
            $table->json('needy_category_target_group_ids');

            $table->json('social_service_ids');
            
            $table->text('qualitative_results');
            $table->text('social_results');
            $table->text('replicability')->nullable();

            $table->json('approbation')->nullable();

            $table->json('expert_opinion')->nullable();
            $table->json('review')->nullable();
            $table->json('comment')->nullable();

            $table->string('video')->nullable();
            $table->text('required_resources_description');

            $table->unsignedBigInteger('photo_file_id')->nullable();
            $table->foreign('photo_file_id')->references('id')->on('user_files');

            $table->json('gallery_file_ids');

            $table->boolean('is_best_practice');
            $table->boolean('is_remote_format_possible');

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
        Schema::dropIfExists('job_primary_information');
    }
};
