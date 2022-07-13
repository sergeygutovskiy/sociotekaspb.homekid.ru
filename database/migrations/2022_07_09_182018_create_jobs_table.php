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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');            

            $table->unsignedBigInteger('primary_info_id');
            $table->foreign('primary_info_id')->references('id')->on('job_primary_infos');

            $table->unsignedBigInteger('experience_id');
            $table->foreign('experience_id')->references('id')->on('job_experiences');

            $table->enum('status', [ 'accepted', 'pending', 'rejected' ])->default('pending');
            $table->text('rejected_status_description')->nullable();

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
        Schema::dropIfExists('jobs');
    }
};
