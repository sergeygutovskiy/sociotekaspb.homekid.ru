<?php

namespace Database\Seeders\Job;

use App\Enums\JobStatus;
use App\Models\Job\Job;
use App\Models\Job\JobContacts;
use App\Models\Job\JobExperience;
use App\Models\Job\JobPrimaryInformation;
use App\Models\Job\JobReportingPeriod;
use App\Models\User;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    const JOBS_COUNT = 25;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job_user = User::first();
        $job_primary_information_ids = JobPrimaryInformation::factory()->count(self::JOBS_COUNT)->create()->pluck('id');
        $job_experience_ids = JobExperience::factory()->count(self::JOBS_COUNT)->create()->pluck('id');
        $job_contacts_ids = JobContacts::factory()->count(self::JOBS_COUNT)->create()->pluck('id');

        $jobs = collect();
        for ( $i = 0; $i < $job_primary_information_ids->count(); $i++ )
        {
            $jobs->add(new Job([
                'primary_information_id' => $job_primary_information_ids[$i],
                'experience_id' => $job_experience_ids[$i],
                'contacts_id' => $job_contacts_ids[$i],
                'status' => fake()->randomElement([ JobStatus::ACCEPTED, JobStatus::PENDING, JobStatus::REJECTED ]),
                'created_at' => fake()->dateTimeBetween('-5 years'),
            ]));
        }

        $jobs_ids = $job_user->jobs()->saveMany($jobs)->pluck('id');
        $jobs_ids->each(fn($id) => JobReportingPeriod::factory()->count(3)->create([ 'job_id' => $id]));

        $jobs = Job::all();
        $jobs->each(fn($job) => $job->update([ 'rating' => $job->rating_expanded->count ]));
    }
}
