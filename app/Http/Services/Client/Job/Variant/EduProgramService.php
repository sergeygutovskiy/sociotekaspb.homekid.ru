<?php

namespace App\Http\Services\Client\Job\Variant;

use App\Enums\JobVariant;
use App\Http\Services\Client\Job\JobService;
use App\Models\User;
use Illuminate\Http\Request;

class EduProgramService
{
    public static function list_by_user(Request $request, User $user)
    {
        $jobs = JobService::list_by_user($request, JobVariant::EDU_PROGRAM, $user);
        return self::list($request, $jobs);
    }

    public static function list_all(Request $request)
    {
        $jobs = JobService::list_all($request, JobVariant::EDU_PROGRAM);
        return self::list($request, $jobs);
    }

    public static function list_all_deleted(Request $request)
    {
        $jobs = JobService::list_all_deleted($request, JobVariant::EDU_PROGRAM);
        return self::list($request, $jobs);
    }

    private static function list(Request $request, $jobs)
    {
        $direction_id_filter = $request->validated('filter_direction_id');

        $query = $jobs->whereHas(JobVariant::EDU_PROGRAM, fn($q) => $q
            ->optionalHasDirection($direction_id_filter)
        );

        return JobService::paginate($request, $query, JobVariant::EDU_PROGRAM);
    }
}