<?php

namespace Database\Seeders\Job\Variant;

use App\Models\Job\Job;
use App\Models\Job\Variant\SocialWork;
use Illuminate\Database\Seeder;

class SocialWorkSeeder extends Seeder
{
    protected $model = SocialWork::class;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs_ids = Job::offset(15)->take(5)->pluck('id');
        $jobs_ids->map(fn($id) => SocialWork::factory()->create([ 'job_id' => $id ]));
    }
}
