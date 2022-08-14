<?php

namespace App\Http\Controllers\Admin\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Job\ApproveRequest;
use App\Http\Requests\Admin\Job\RejectRequest;
use App\Http\Requests\Client\Job\SocialProject\ListRequest;
use App\Http\Resources\Admin\Job\SocialProjectItemListResource;
use App\Http\Services\Admin\JobService;
use App\Http\Responses\OKResponse;
use App\Http\Services\Client\SocialProjectService;
use App\Models\Job\SocialProject;
use App\Models\User;

class SocialProjectController extends Controller
{
    public function approve(ApproveRequest $request, User $user, SocialProject $social_project)
    {
        JobService::approve($request, $social_project->job());
        return OKResponse::response();
    }

    public function reject(RejectRequest $request, User $user, SocialProject $social_project)
    {
        JobService::reject($request, $social_project->job());
        return OKResponse::response();
    }

    public function index(ListRequest $request)
    {
        $paginated = SocialProjectService::list_all($request);
        $items = SocialProjectItemListResource::collection($paginated->items);

        return OKResponse::response([
            'items' => $items,
            'total' => $paginated->total,
        ]);
    }
}
