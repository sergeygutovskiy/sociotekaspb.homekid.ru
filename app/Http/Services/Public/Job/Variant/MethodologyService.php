<?php

namespace App\Http\Services\Public\Job\Variant;

use App\Enums\JobVariant;
use App\Http\Services\Public\Job\JobService;
use App\Http\Validators\Validator;
use App\Models\Job\Job;
use Illuminate\Http\Request;

class MethodologyService
{
    public static function list(Request $request)
    {
        $filter_direction_id = $request->validated('filter_direction_id');
        $filter_application_period_id = $request->validated('filter_application_period_id');
        $filter_prevalence_id = $request->validated('filter_prevalence_id');
        $filter_is_effectiveness_study = $request->validated('filter_is_effectiveness_study');

        $service_type_ids_filter = Validator::parse_query_ids($request->validated('filter_service_type_ids'));
        $service_name_ids_filter = Validator::parse_query_ids($request->validated('filter_service_name_ids'));
        $public_work_ids_filter = Validator::parse_query_ids($request->validated('filter_public_work_ids'));

        $query = Job::whereHas(JobVariant::METHODOLOGY, fn($q) => $q
            ->optionalHasDirection($filter_direction_id)
            ->optionalHasPrevalence($filter_prevalence_id)
            ->optionalHasApplicationPeriod($filter_application_period_id)
            ->optionalIsHasEffectivenessStudy($filter_is_effectiveness_study)
            ->optionalHasServiceTypes($service_type_ids_filter)
            ->optionalHasServiceNames($service_name_ids_filter)
            ->optionalHasPublicWorks($public_work_ids_filter)
        );

        return JobService::list_approved_with_approved_company($request, JobVariant::METHODOLOGY, $query);
    }
}
