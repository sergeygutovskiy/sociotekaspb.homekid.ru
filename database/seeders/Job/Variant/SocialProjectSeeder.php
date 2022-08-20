<?php

namespace Database\Seeders\Job\Variant;

use App\Models\Job\Job;
use App\Models\Job\Variant\SocialProject;
use Illuminate\Database\Seeder;

class SocialProjectSeeder extends Seeder
{
    protected $model = SocialProject::class;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs_ids = Job::take(5)->pluck('id');
        $jobs_ids->map(fn($id) => SocialProject::factory()->create([ 'job_id' => $id ]));
    }
}
