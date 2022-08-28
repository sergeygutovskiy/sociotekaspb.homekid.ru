<?php

namespace Database\Seeders\Job\Variant;

use App\Enums\JobVariant;
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
        $jobs_ids = Job::offset(15)->take(5)->pluck('id');
        $variants = $jobs_ids->map(fn($id) => SocialProject::factory()->create([ 'job_id' => $id ]));

        Job::whereIn('id', $jobs_ids)->update([ 'variant' => JobVariant::SOCIAL_PROJECT ]);
        $variants->each(fn($variant) => Job::find($variant->job_id)->update(['variant_id' => $variant->id]));
    }
}
