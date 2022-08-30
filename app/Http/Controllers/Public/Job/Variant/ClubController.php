<?php

namespace App\Http\Controllers\Public\Job\Variant;

use App\Enums\JobVariant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Job\Club\ListRequest;
use App\Http\Resources\Public\Job\ListApprovedResource;
use App\Http\Resources\Public\Job\Variant\Club\Resource;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\Public\Job\JobService;
use App\Http\Services\Public\Job\Variant\ClubService;

class ClubController extends Controller
{
    public function show_approved(int $id)
    {
        $job = JobService::approved_with_approved_company(JobVariant::CLUB, $id)->firstOrFail();
        return ResourceOKResponse::response(new Resource($job->club));
    }

    public function show_best(int $id)
    {
        $job = JobService::best(JobVariant::CLUB, $id)->firstOrFail();
        return ResourceOKResponse::response(new Resource($job->club));
    }

    public function list_approved(ListRequest $request)
    {
        $paginated = ClubService::list($request);
        return ResourceOKResponse::response([
            'total' => $paginated->total,
            'items' => ListApprovedResource::collection($paginated->items),
        ]);
    }
}
