<?php

namespace App\Http\Controllers\Public\Job;

use App\Enums\JobVariant;
use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Job\Variant\SocialProject\Resource;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\Public\JobService;

class SocialProjectController extends Controller
{
    public function show_approved(int $id)
    {
        $job = JobService::approvedWithApprovedCompany(JobVariant::SOCIAL_PROJECT, $id)->firstOrFail();
        return ResourceOKResponse::response(new Resource($job->social_project));
    }

    public function show_best(int $id)
    {
        $job = JobService::best(JobVariant::SOCIAL_PROJECT, $id)->firstOrFail();
        return ResourceOKResponse::response(new Resource($job->social_project));
    }
}
