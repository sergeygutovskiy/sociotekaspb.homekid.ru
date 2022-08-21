<?php

namespace App\Http\Services\Client\Job\Variant;

use App\Enums\JobVariant;
use App\Http\Services\Client\Job\JobService;
use App\Http\Validators\Validator;
use App\Models\User;
use Illuminate\Http\Request;

class SocialWorkService
{
    public static function list_by_user(Request $request, User $user)
    {
        $jobs = JobService::list_by_user($request, JobVariant::SOCIAL_WORK, $user);
        return self::list($request, $jobs);
    }

    public static function list_all(Request $request)
    {
        $jobs = JobService::list_all($request, JobVariant::SOCIAL_WORK);
        return self::list($request, $jobs);
    }

    public static function list_all_deleted(Request $request)
    {
        $jobs = JobService::list_all_deleted($request, JobVariant::SOCIAL_WORK);
        return self::list($request, $jobs);
    }

    private static function list(Request $request, $jobs)
    {
        $direction_id_filter = $request->validated('filter_direction_id');

        $service_type_ids_filter = Validator::parse_query_ids($request->validated('filter_service_type_ids'));
        $service_name_ids_filter = Validator::parse_query_ids($request->validated('filter_service_name_ids'));
        $public_work_ids_filter = Validator::parse_query_ids($request->validated('filter_public_work_ids'));

        $query = $jobs->whereHas(JobVariant::SOCIAL_WORK, fn($q) => $q
            ->optionalHasServiceTypes($service_type_ids_filter)
            ->optionalHasServiceNames($service_name_ids_filter)
            ->optionalHasPublicWorks($public_work_ids_filter)
            ->optionalHasDirection($direction_id_filter)
        );

        return JobService::paginate($request, $query, JobVariant::SOCIAL_WORK);
    }
}