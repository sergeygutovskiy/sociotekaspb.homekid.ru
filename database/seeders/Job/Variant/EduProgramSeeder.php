<?php

namespace Database\Seeders\Job\Variant;

use App\Models\Job\Job;
use App\Models\Job\Variant\EduProgram;
use Illuminate\Database\Seeder;

class EduProgramSeeder extends Seeder
{
    protected $model = EduProgram::class;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs_ids = Job::offset(5)->take(5)->pluck('id');
        $jobs_ids->map(fn($id) => EduProgram::factory()->create([ 'job_id' => $id ]));
    }
}
