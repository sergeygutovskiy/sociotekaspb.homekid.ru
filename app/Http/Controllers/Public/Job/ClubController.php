<?php

namespace App\Http\Controllers\Public\Job;

use App\Enums\JobVariant;
use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Job\Variant\Club\BestResource;
use App\Http\Resources\Public\Job\Variant\Club\Resource;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\Public\JobService;

class ClubController extends Controller
{
    public function show_approved(int $id)
    {
        $job = JobService::approvedWithApprovedCompany(JobVariant::CLUB, $id)->firstOrFail();
        return ResourceOKResponse::response(new Resource($job->club));
    }

    public function show_best(int $id)
    {
        $job = JobService::best(JobVariant::CLUB, $id)->firstOrFail();
        return ResourceOKResponse::response(new Resource($job->club));
    }
}
