<?php

namespace App\Http\Controllers\Public\Job\Variant;

use App\Enums\JobVariant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Job\SocialWork\ListRequest;
use App\Http\Resources\Public\Job\ListApprovedResource;
use App\Http\Resources\Public\Job\Variant\SocialWork\Resource;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\Public\Job\JobService;
use App\Http\Services\Public\Job\Variant\SocialWorkService;

class SocialWorkController extends Controller
{
    public function show_approved(int $id)
    {
        $job = JobService::approved_with_approved_company(JobVariant::SOCIAL_WORK, $id)->firstOrFail();
        return ResourceOKResponse::response(new Resource($job->social_work));
    }

    public function show_best(int $id)
    {
        $job = JobService::best(JobVariant::SOCIAL_WORK, $id)->firstOrFail();
        return ResourceOKResponse::response(new Resource($job->social_work));
    }

    public function list_approved(ListRequest $request)
    {
        $paginated = SocialWorkService::list($request);
        return ResourceOKResponse::response([
            'total' => $paginated->total,
            'items' => ListApprovedResource::collection($paginated->items),
        ]);
    }
}
