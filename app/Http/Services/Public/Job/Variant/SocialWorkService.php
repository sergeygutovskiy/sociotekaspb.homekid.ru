<?php

namespace App\Http\Services\Public\Job\Variant;

use App\Enums\JobVariant;
use App\Http\Services\Public\Job\JobService;
use App\Http\Validators\Validator;
use App\Models\Job\Job;
use Illuminate\Http\Request;

class SocialWorkService
{
    public static function list(Request $request)
    {
        $direction_id_filter = $request->validated('filter_direction_id');

        $service_type_ids_filter = Validator::parse_query_ids($request->validated('filter_service_type_ids'));
        $service_name_ids_filter = Validator::parse_query_ids($request->validated('filter_service_name_ids'));
        $public_work_ids_filter = Validator::parse_query_ids($request->validated('filter_public_work_ids'));

        $query = Job::whereHas(JobVariant::SOCIAL_WORK, fn($q) => $q
            ->optionalHasServiceTypes($service_type_ids_filter)
            ->optionalHasServiceNames($service_name_ids_filter)
            ->optionalHasPublicWorks($public_work_ids_filter)
            ->optionalHasDirection($direction_id_filter)
        );

        return JobService::list_approved_with_approved_company($request, JobVariant::SOCIAL_WORK, $query);
    }
}