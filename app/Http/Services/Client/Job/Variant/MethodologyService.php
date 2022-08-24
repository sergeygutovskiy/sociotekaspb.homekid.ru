<?php

namespace App\Http\Services\Client\Job\Variant;

use App\Enums\JobVariant;
use App\Http\Services\Client\Job\JobService;
use App\Models\User;
use Illuminate\Http\Request;

class MethodologyService
{
    public static function list_by_user(Request $request, User $user)
    {
        $jobs = JobService::list_by_user($request, JobVariant::METHODOLOGY, $user);
        return self::list($request, $jobs);
    }

    public static function list_all(Request $request)
    {
        $jobs = JobService::list_all($request, JobVariant::METHODOLOGY);
        return self::list($request, $jobs);
    }

    public static function list_all_deleted(Request $request)
    {
        $jobs = JobService::list_all_deleted($request, JobVariant::METHODOLOGY);
        return self::list($request, $jobs);
    }

    private static function list(Request $request, $jobs)
    {
        $filter_direction_id = $request->validated('filter_direction_id');
        $filter_application_period_id = $request->validated('filter_application_period_id');
        $filter_prevalence_id = $request->validated('filter_prevalence_id');
        $filter_is_effectiveness_study = $request->validated('filter_is_effectiveness_study');

        $query = $jobs->whereHas(JobVariant::METHODOLOGY, fn($q) => $q
            ->optionalHasDirection($filter_direction_id)
            ->optionalHasPrevalence($filter_prevalence_id)
            ->optionalHasApplicationPeriod($filter_application_period_id)
            ->optionalIsHasEffectivenessStudy($filter_is_effectiveness_study)
        );

        return JobService::paginate($request, $query, JobVariant::METHODOLOGY);
    }
}
