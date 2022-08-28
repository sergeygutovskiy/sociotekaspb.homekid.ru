<?php

namespace Database\Seeders\Job\Variant;

use App\Models\Job\Job;
use App\Models\Job\Variant\Club;
use App\Models\Job\Variant\EduProgram;
use Illuminate\Database\Seeder;
use App\Enums\JobVariant;

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
        $jobs_ids = Job::take(5)->pluck('id');
        $variants = $jobs_ids->map(fn($id) => Club::factory()->create([ 'job_id' => $id ]));

        Job::whereIn('id', $jobs_ids)->update([ 'variant' => JobVariant::CLUB ]);
        $variants->each(fn($variant) => Job::find($variant->job_id)->update(['variant_id' => $variant->id]));
    }
}
