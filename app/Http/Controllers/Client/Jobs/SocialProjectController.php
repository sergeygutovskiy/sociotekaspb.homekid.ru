<?php

namespace App\Http\Controllers\Client\Jobs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Job\SocialProject\StoreRequest;
use App\Http\Responses\Auth\UserNotFoundErrorResponse;
use App\Http\Responses\OKResponse;
use App\Models\Job\Job;
use App\Models\Job\JobContacts;
use App\Models\Job\JobExperience;
use App\Models\Job\JobPrimaryInformation;
use App\Models\Job\JobReportingPeriod;
use App\Models\User;

class SocialProjectController extends Controller
{
    public function store(StoreRequest $request, int $user_id)
    {
        $user = User::find($user_id);
        if ( !$user ) return UserNotFoundErrorResponse::response();

        $validated_data = $request->validated();

        $primary_data = $validated_data['primary'];
        $contacts_data = $validated_data['contacts'];
        $experience_data = $validated_data['experience'];
        $info_data = $validated_data['info'];
        $reporting_periods_data = $validated_data['reporting_periods'];

        $job_primary = JobPrimaryInformation::create($primary_data);
        $job_contacts = JobContacts::create($contacts_data);
        $job_experience = JobExperience::create($experience_data);

        $job = $user->jobs()->create([
            'primary_information_id' => $job_primary->id,
            'experience_id' => $job_experience->id,
            'contacts_id' => $job_contacts->id,
        ]);

        $reporting_periods = array_map(fn($data) => new JobReportingPeriod($data), $reporting_periods_data);
        $job->reporting_periods()->saveMany($reporting_periods);

        $social_project = $job->social_projects()->create($info_data);

        return OKResponse::response([
            'social_project' => [
                'id' => $social_project->id 
            ],
        ]);
    }
}
