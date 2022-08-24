<?php

namespace Database\Seeders\Job\Variant;

use App\Models\Job\Job;
use App\Models\Job\Variant\Methodology;
use Illuminate\Database\Seeder;

class MethodologySeeder extends Seeder
{
    protected $model = Methodology::class;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs_ids = Job::offset(20)->take(5)->pluck('id');
        $jobs_ids->map(fn($id) => Methodology::factory()->create([ 'job_id' => $id ]));
    }
}
