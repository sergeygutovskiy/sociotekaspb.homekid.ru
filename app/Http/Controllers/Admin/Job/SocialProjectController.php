<?php

namespace App\Http\Controllers\Admin\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Job\ApproveRequest;
use App\Http\Requests\Admin\Job\RejectRequest;
use App\Http\Requests\Client\Job\SocialProject\ListRequest;
use App\Http\Resources\Admin\Job\Variant\SocialProject\DeletedItemListResource;
use App\Http\Resources\Admin\Job\Variant\SocialProject\ItemListResource;
use App\Http\Resources\Admin\Job\Variant\SocialProject\Resource;
use App\Http\Responses\Auth\AccessDeniedErrorResponse;
use App\Http\Services\Admin\JobService;
use App\Http\Responses\OKResponse;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\Client\Job\Variant\SocialProjectService;
use App\Models\Job\Variant\SocialProject;
use App\Models\User;
use Illuminate\Http\Request;

class SocialProjectController extends Controller
{
    public function show(Request $request, User $user, SocialProject $social_project)
    {
        if ( $request->user()->cannot('view', $user) ) return AccessDeniedErrorResponse::response();
        return ResourceOKResponse::response(new Resource($social_project));
    }

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

    public function restore(Request $request, User $user, SocialProject $social_project)
    {
        $social_project->trashed_job->restore();
        return OKResponse::response();
    }

    public function index(ListRequest $request)
    {
        $paginated = SocialProjectService::list_all($request);
        $items = ItemListResource::collection($paginated->items);

        return OKResponse::response([
            'items' => $items,
            'total' => $paginated->total,
        ]);
    }

    public function index_deleted(ListRequest $request)
    {
        $paginated = SocialProjectService::list_all_deleted($request);
        $items = DeletedItemListResource::collection($paginated->items);

        return OKResponse::response([
            'items' => $items,
            'total' => $paginated->total,
        ]);
    }
}
