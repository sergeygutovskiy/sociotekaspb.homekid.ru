<?php

namespace App\Http\Controllers\Public\Job;

use App\Enums\JobVariant;
use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Job\Variant\EduProgram\Resource;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\Public\JobService;

class EduProgramController extends Controller
{
    public function show_approved(int $id)
    {
        $job = JobService::approvedWithApprovedCompany(JobVariant::EDU_PROGRAM, $id)->firstOrFail();
        return ResourceOKResponse::response(new Resource($job->edu_program));
    }

    public function show_best(int $id)
    {
        $job = JobService::best(JobVariant::EDU_PROGRAM, $id)->firstOrFail();
        return ResourceOKResponse::response(new Resource($job->edu_program));
    }
}
