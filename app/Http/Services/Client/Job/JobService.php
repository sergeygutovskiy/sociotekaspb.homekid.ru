<?php

namespace App\Http\Services\Client\Job;

use App\Enums\JobStatus;
use App\Http\Validators\Validator;
use App\Models\Job\Job;
use App\Models\Job\JobContacts;
use App\Models\Job\JobExperience;
use App\Models\Job\JobPrimaryInformation;
use App\Models\Job\JobReportingPeriod;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use stdClass;

class JobService
{
    public static function create_job(Request $request, User $user): Job
    {
        $request_data = $request->all();

        $primary_data = $request_data['primary'];
        $contacts_data = $request_data['contacts'];
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

        // set job initial rating

        $job->update([ 'rating' => $job->rating_expanded->count ]);

        // create job' reporting periods 

        $reporting_periods = array_map(fn($data) => new JobReportingPeriod($data), $reporting_periods_data);
        $job->reporting_periods()->saveMany($reporting_periods);

        return $job;
    }

    public static function update_job(Request $request, Job $job): void
    {
        $request_data = $request->all();

        $primary_data = $request_data['primary'];
        $contacts_data = $request_data['contacts'];
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

        $job->update([ 
            'status' => JobStatus::PENDING,
            'rating' => $job->rating_expanded->count,
            'updated_at' => Carbon::now(),
        ]);
    }

    public static function list_all(Request $request, string $job_variant)
    {
        $company_filter = $request->input('filter_company');

        $query = Job::optionalHasCompany($company_filter);
        return self::list($request, $job_variant, $query);
    }

    public static function list_all_deleted(Request $request, string $job_variant)
    {
        $company_filter = $request->input('filter_company');

        $query = Job::onlyTrashed()->optionalHasCompany($company_filter);
        return self::list($request, $job_variant, $query);
    }

    public static function list_by_user(Request $request, string $job_variant, User $user)
    {
        $query = $user->jobs();
        return self::list($request, $job_variant, $query);
    }

    private static function list(Request $request, string $job_variant, $initial_query)
    {
        $name_filter = $request->input('filter_name');
        $status_filter = $request->input('filter_status');
        $rating_filter = $request->input('filter_rating');
        $year_filter = $request->input('filter_year');

        $is_any_review_filter = $request->input('filter_is_any_review');
        $is_approbation_filter = $request->input('filter_is_approbation');
        $is_remote_format_filter = $request->input('filter_is_remote_format');
        $is_favorite_filter = $request->input('filter_is_favorite');
        $is_publication_filter = $request->input('filter_is_publication');
        $volunteer_id_filter = $request->input('filter_volunteer_id');

        $rnsu_category_ids_filter = $request->input('filter_rnsu_category_ids');
        $rnsu_category_ids_filter = Validator::parse_query_ids($rnsu_category_ids_filter);

        $needy_category_ids_filter = $request->input('filter_needy_category_ids');
        $needy_category_ids_filter = Validator::parse_query_ids($needy_category_ids_filter);

        $needy_category_target_group_ids_filter = $request->input('filter_needy_category_target_group_ids');
        $needy_category_target_group_ids_filter = Validator::parse_query_ids($needy_category_target_group_ids_filter);

        $social_service_ids_filter = $request->input('filter_social_service_ids');
        $social_service_ids_filter = Validator::parse_query_ids($social_service_ids_filter);

        $sort_by = $request->input('sort_by');
        $sort_direction = $request->input('sort_direction');

        $query = $initial_query
            ->whereHas($job_variant, fn($q) => $q->withTrashed())
            ->with('primary_information')
            ->optionalHasNameLike($name_filter)
            ->optionalHasStatus($status_filter)
            ->optionalHasRating($rating_filter)
            ->optionalHasReportingPeriodOfYear($year_filter)
            ->optionalHasVolunteer($volunteer_id_filter)
            ->optionalHasAnyReview($is_any_review_filter)
            ->optionalHasApprobation($is_approbation_filter)
            ->optionalHasPublication($is_publication_filter)
            ->optionalIsRemoteFormat($is_remote_format_filter)
            ->optionalHasRnsuCategories($rnsu_category_ids_filter)
            ->optionalHasNeedyCategories($needy_category_ids_filter)
            ->optionalHasNeedyCategoryTargetGroups($needy_category_target_group_ids_filter)
            ->optionalHasSocialServices($social_service_ids_filter)
            ->optionalIsFavorite($is_favorite_filter)
            ->optionalOrderBy($sort_by, $sort_direction)
        ;

        return $query;
    }

    public static function paginate(Request $request, $query)
    {
        $page = $request->input('page');
        $limit = $request->input('limit');

        $paginated = new stdClass();
        $paginated->total = $query->count();
        $paginated->items = $query->skip(($page - 1) * $limit)->take($limit)->get();

        return $paginated;
    }
}