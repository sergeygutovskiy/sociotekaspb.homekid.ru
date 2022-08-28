<?php

use App\Enums\JobVariant;
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

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('primary_information_id');
            $table->foreign('primary_information_id')->references('id')->on('job_primary_information');

            $table->unsignedBigInteger('experience_id');
            $table->foreign('experience_id')->references('id')->on('job_experiences');

            $table->unsignedBigInteger('contacts_id');
            $table->foreign('contacts_id')->references('id')->on('job_contacts');

            $table->enum('status', [ 'accepted', 'pending', 'rejected' ])->default('pending');
            $table->text('rejected_status_description')->nullable();

            $table->boolean('is_favorite')->default(false);
            $table->unsignedInteger('rating')->default(0)->max(6);

            $table->enum('variant', [
                JobVariant::SOCIAL_PROJECT,
                JobVariant::SOCIAL_WORK,
                JobVariant::CLUB,
                JobVariant::EDU_PROGRAM,
                JobVariant::METHODOLOGY,
            ])->nullable();
            $table->unsignedBigInteger('variant_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
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
