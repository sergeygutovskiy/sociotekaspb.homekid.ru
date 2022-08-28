<?php

namespace Database\Seeders\Job\Variant;

use App\Enums\JobVariant;
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
        $variants = $jobs_ids->map(fn($id) => EduProgram::factory()->create([ 'job_id' => $id ]));

        Job::whereIn('id', $jobs_ids)->update([ 'variant' => JobVariant::EDU_PROGRAM ]);
        $variants->each(fn($variant) => Job::find($variant->job_id)->update(['variant_id' => $variant->id]));
    }
}
