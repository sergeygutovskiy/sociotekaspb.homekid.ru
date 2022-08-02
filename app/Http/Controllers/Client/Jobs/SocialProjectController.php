<?php

namespace App\Http\Controllers\Client\Jobs;

use App\Enums\JobStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Job\SocialProject\StoreRequest;
use App\Http\Requests\Client\Job\SocialProject\UpdateRequest;
use App\Http\Resources\Client\Job\SocialProjectResource;
use App\Http\Responses\Auth\UserNotFoundErrorResponse;
use App\Http\Responses\OKResponse;
use App\Http\Responses\Resources\ResourceNotFoundErrorResponse;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Models\Job\JobContacts;
use App\Models\Job\JobExperience;
use App\Models\Job\JobPrimaryInformation;
use App\Models\Job\JobReportingPeriod;
use App\Models\Job\SocialProject;
use App\Models\User;
use Illuminate\Support\Facades\Request;

class SocialProjectController extends Controller
{
    public function store(StoreRequest $request, int $user_id)
    {
        $user = User::find($user_id);
        if ( !$user ) return UserNotFoundErrorResponse::response();

        $request_data = $request->all();
        $validated_data = $request->validated();

        $primary_data = $validated_data['primary'];
        $contacts_data = $validated_data['contacts'];
        $info_data = $validated_data['info'];
        $experience_data = $request_data['experience'];
        $reporting_periods_data = $request_data['reporting_periods'];

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

        // create social project from job 

        $social_project = $job->social_projects()->create($info_data);

        return OKResponse::response([
            'social_project' => [ 'id' => $social_project->id ],
        ]);
    }

    public function show(int $user_id, int $id)
    {
        $user = User::find($user_id);
        if ( !$user ) return UserNotFoundErrorResponse::response();

        $social_project = SocialProject::find($id);
        if ( !$social_project ) return ResourceNotFoundErrorResponse::response();

        return ResourceOKResponse::response(new SocialProjectResource($social_project));
    }

    public function update(UpdateRequest $request, int $user_id, int $id)
    {
        $user = User::find($user_id);
        if ( !$user ) return UserNotFoundErrorResponse::response();

        $social_project = SocialProject::find($id);
        if ( !$social_project ) return ResourceNotFoundErrorResponse::response();

        $request_data = $request->all();
        $validated_data = $request->validated();

        $primary_data = $validated_data['primary'];
        $contacts_data = $validated_data['contacts'];
        $info_data = $validated_data['info'];
        $experience_data = $request_data['experience'];
        $reporting_periods_data = $request_data['reporting_periods'];

        // update primary_information, experience and contacts

        $social_project->job->primary_information()->update($primary_data);
        $social_project->job->experience()->update($experience_data);
        $social_project->job->contacts()->update($contacts_data);
        
        //  get newly created and updated reporting periods

        $reporting_periods = collect($reporting_periods_data);
        $new_reporting_periods = $reporting_periods->whereNull('id');
        $updated_reporting_periods = $reporting_periods->whereNotNull('id');

        // remove deleted reporting periods

        $updated_period_ids = $updated_reporting_periods->pluck('id');
        $social_project->job->reporting_periods()->whereNotIn('id', $updated_period_ids)->delete();

        // create new reporting periods

        $new_reporting_periods = array_map(fn($data) => new JobReportingPeriod($data), $new_reporting_periods->toArray());
        $social_project->job->reporting_periods()->saveMany($new_reporting_periods);

        // update old reporting periods
        
        foreach ($updated_reporting_periods as $period_data)
        {
            $period = $social_project->job->reporting_periods()->find($period_data['id']);
            if ( !$period ) continue;

            unset($period_data['id']);
            $period->update($period_data);
        }

        // update social project

        $social_project->update($info_data);
        $social_project->job()->update([ 'status' => JobStatus::PENDING ]);

        return OKResponse::response();
    }

    public function index(Request $request)
    {
        $page = $request->input('page');
        $limit = $request->input('limit');

        $name_filter = $request->input('filter_name');
        $status_filter = $request->input('filter_status');

        $items = SocialProject::skip(($page - 1) * $limit)->take($limit);
        return $items;
    }
}
