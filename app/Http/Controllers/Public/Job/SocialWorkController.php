<?php

namespace App\Http\Controllers\Public\Job;

use App\Enums\JobVariant;
use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Job\Variant\SocialWork\Resource;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\Public\JobService;

class SocialWorkController extends Controller
{
    public function show_approved(int $id)
    {
        $job = JobService::approvedWithApprovedCompany(JobVariant::SOCIAL_WORK, $id)->firstOrFail();
        return ResourceOKResponse::response(new Resource($job->social_work));
    }

    public function show_best(int $id)
    {
        $job = JobService::best(JobVariant::SOCIAL_WORK, $id)->firstOrFail();
        return ResourceOKResponse::response(new Resource($job->social_work));
    }
}
