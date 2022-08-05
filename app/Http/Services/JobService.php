<?php

namespace App\Http\Services;

use App\Enums\JobStatus;
use App\Models\Job\Job;
use App\Models\Job\JobContacts;
use App\Models\Job\JobExperience;
use App\Models\Job\JobPrimaryInformation;
use App\Models\Job\JobReportingPeriod;
use App\Models\User;
use Illuminate\Http\Request;

class JobService
{
    public static function create_job(Request $request, User $user): Job
    {
        $request_data = $request->all();
        $validated_data = $request->validated();

        $primary_data = $validated_data['primary'];
        $contacts_data = $validated_data['contacts'];
        $experience_data = $request_data['experience'];
        $reporting_periods_data = $request_data['reporting_periods'];

        // create job' contacts, experience, primary info

        $job_primary = JobPrimaryInformation::create($primary_data);
        $job_contacts = JobContacts::create($contacts_data);
        $job_experience = JobExperience::create($experience_data);

        // create job

        $job = $user->jobs()->create([
            'primary_information_id' => $job_primary->id,
            'experience_id' => $job_experience->id,
            'contacts_id' => $job_contacts->id,
        ]);

        // create job' reporting periods 

        $reporting_periods = array_map(fn($data) => new JobReportingPeriod($data), $reporting_periods_data);
        $job->reporting_periods()->saveMany($reporting_periods);

        return $job;
    }

    public static function update_job(Request $request, Job $job): void
    {
        $request_data = $request->all();
        $validated_data = $request->validated();

        $primary_data = $validated_data['primary'];
        $contacts_data = $validated_data['contacts'];
        $experience_data = $request_data['experience'];
        $reporting_periods_data = $request_data['reporting_periods'];

        // update primary_information, experience and contacts

        $job->primary_information()->update($primary_data);
        $job->experience()->update($experience_data);
        $job->contacts()->update($contacts_data);
        
        //  get newly created and updated reporting periods

        $reporting_periods = collect($reporting_periods_data);
        $new_reporting_periods = $reporting_periods->whereNull('id');
        $updated_reporting_periods = $reporting_periods->whereNotNull('id');

        // remove deleted reporting periods

        $updated_period_ids = $updated_reporting_periods->pluck('id');
        $job->reporting_periods()->whereNotIn('id', $updated_period_ids)->delete();

        // create new reporting periods

        $new_reporting_periods = array_map(fn($data) => new JobReportingPeriod($data), $new_reporting_periods->toArray());
        $job->reporting_periods()->saveMany($new_reporting_periods);

        // update old reporting periods
        
        foreach ($updated_reporting_periods as $period_data)
        {
            $period = $job->reporting_periods()->find($period_data['id']);
            if ( !$period ) continue;

            unset($period_data['id']);
            $period->update($period_data);
        }

        $job->update([ 'status' => JobStatus::PENDING ]);
    }

    public static function list(Request $request, User $user, string $job_variant)
    {
        $page = $request->input('page');
        $limit = $request->input('limit');

        $name_filter = $request->input('filter_name');
        $status_filter = $request->input('filter_status');

        $query = $user->jobs()->with('primary_information')->whereHas($job_variant);
        if ( $name_filter ) $query = $query->whereHas('primary_information', fn($q) => $q->where('name', 'like', '%'.$name_filter.'%'));
        if ( $status_filter ) $query = $query->where('status', $status_filter);

        $total = $query->count();
        $items = $query->skip(($page - 1) * $limit)->take($limit)->get();

        return [
            'total' => $total,
            'items' => $items,
        ];
    }
}