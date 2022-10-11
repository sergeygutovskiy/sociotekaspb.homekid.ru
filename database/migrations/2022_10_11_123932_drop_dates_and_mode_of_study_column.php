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
        Schema::table('social_works', function(Blueprint $table) {
            $table->dropColumn('dates_and_mode_of_study');
        });

        Schema::table('edu_programs', function(Blueprint $table) {
            $table->dropColumn('dates_and_mode_of_study');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
