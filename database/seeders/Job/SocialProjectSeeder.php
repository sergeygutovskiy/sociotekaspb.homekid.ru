<?php

namespace Database\Seeders\Job;

use App\Models\Job\Job;
use App\Models\Job\SocialProject;
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
        $jobs_ids = Job::all()->pluck('id');
        $jobs_ids->map(fn($id) => SocialProject::factory()->create([ 'job_id' => $id ]));
    }
}
