<?php

namespace App\Http\Controllers\Public\Job\Variant;

use App\Enums\JobVariant;
use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Job\Variant\Methodology\Resource;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\Public\JobService;

class MethodologyController extends Controller
{
    public function show_approved(int $id)
    {
        $job = JobService::approved_with_approved_company(JobVariant::METHODOLOGY, $id)->firstOrFail();
        return ResourceOKResponse::response(new Resource($job->methodology));
    }

    public function show_best(int $id)
    {
        $job = JobService::best(JobVariant::METHODOLOGY, $id)->firstOrFail();
        return ResourceOKResponse::response(new Resource($job->methodology));
    }
}
