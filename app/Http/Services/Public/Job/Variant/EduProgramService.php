<?php

namespace App\Http\Services\Public\Job\Variant;

use App\Enums\JobVariant;
use App\Http\Services\Public\Job\JobService;
use App\Models\Job\Job;
use Illuminate\Http\Request;

class EduProgramService
{
    public static function list(Request $request)
    {
        $direction_id_filter = $request->validated('filter_direction_id');

        $query = Job::whereHas(JobVariant::EDU_PROGRAM, fn($q) => $q
            ->optionalHasDirection($direction_id_filter)
        );

        return JobService::list_approved_with_approved_company($request, JobVariant::EDU_PROGRAM, $query);
    }
}