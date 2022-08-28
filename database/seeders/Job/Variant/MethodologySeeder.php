<?php

namespace Database\Seeders\Job\Variant;

use App\Enums\JobVariant;
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
        $jobs_ids = Job::offset(10)->take(5)->pluck('id');
        $variants = $jobs_ids->map(fn($id) => Methodology::factory()->create([ 'job_id' => $id ]));

        Job::whereIn('id', $jobs_ids)->update([ 'variant' => JobVariant::METHODOLOGY ]);
        $variants->each(fn($variant) => Job::find($variant->job_id)->update(['variant_id' => $variant->id]));
    }
}
