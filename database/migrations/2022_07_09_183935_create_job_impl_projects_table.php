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
        Schema::create('job_impl_projects', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')->references('id')->on('jobs');

            $table->string('implementation_period');
            $table->string('technologies_forms_methods');
            $table->string('main_quantitative_results');
            $table->string('diagnostic_toolkit');
            $table->string('prevalence');

            $table->boolean('is_participant');
            $table->string('organizer')->nullable();

            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('dictionary_categories');

            $table->unsignedBigInteger('service_type_id');
            $table->foreign('service_type_id')->references('id')->on('dictionary_categories');

            $table->unsignedBigInteger('work_name_id');
            $table->foreign('work_name_id')->references('id')->on('dictionary_categories');

            $table->unsignedBigInteger('recognition_of_need_id');
            $table->foreign('recognition_of_need_id')->references('id')->on('dictionary_categories');

            $table->unsignedBigInteger('rnsu_category_id');
            $table->foreign('rnsu_category_id')->references('id')->on('dictionary_categories');

            $table->json('partner_ids');

            $table->string('contacts_responsible_name');
            $table->string('contacts_email');
            $table->string('contacts_phone');

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
        Schema::dropIfExists('job_projects');
    }
};
