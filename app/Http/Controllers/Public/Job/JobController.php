<?php

namespace App\Http\Controllers\Public\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Job\ListRequest;
use App\Http\Resources\Public\Job\ListResource;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\Public\JobService;

class JobController extends Controller
{
    public function list_best(ListRequest $request)
    {
        $jobs = JobService::list_best($request);
        return ResourceOKResponse::response([
            'total' => $jobs->total,
            'items' => ListResource::collection($jobs->items),
        ]);
    }
}
