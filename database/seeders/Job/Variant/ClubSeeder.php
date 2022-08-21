<?php

namespace Database\Seeders\Job\Variant;

use App\Models\Job\Job;
use App\Models\Job\Variant\Club;
use App\Models\Job\Variant\EduProgram;
use Illuminate\Database\Seeder;

class ClubSeeder extends Seeder
{
    protected $model = Club::class;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs_ids = Job::offset(20)->take(5)->pluck('id');
        $jobs_ids->map(fn($id) => Club::factory()->create([ 'job_id' => $id ]));
    }
}
