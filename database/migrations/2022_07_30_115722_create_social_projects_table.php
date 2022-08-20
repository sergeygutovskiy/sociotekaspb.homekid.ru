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
        Schema::create('social_projects', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')->references('id')->on('jobs');

            $table->json('participant')->nullable();
            $table->text('implementation_period');

            $table->unsignedBigInteger('implementation_level_id');
            $table->foreign('implementation_level_id')->references('id')->on('dictionaries');

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
        Schema::dropIfExists('social_projects');
    }
};
