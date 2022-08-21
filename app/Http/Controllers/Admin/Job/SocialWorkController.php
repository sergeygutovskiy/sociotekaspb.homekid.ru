<?php

namespace App\Http\Controllers\Admin\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Job\ApproveRequest;
use App\Http\Requests\Admin\Job\RejectRequest;
use App\Http\Requests\Client\Job\SocialWork\ListRequest;
use App\Http\Resources\Admin\Job\Variant\SocialWork\DeletedItemListResource;
use App\Http\Resources\Admin\Job\Variant\SocialWork\ItemListResource;
use App\Http\Resources\Admin\Job\Variant\SocialWork\Resource;
use App\Http\Responses\OKResponse;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\Admin\JobService;
use App\Http\Services\Client\File\JobFileService;
use App\Http\Services\Client\Job\Variant\SocialWorkService;
use App\Models\Job\Variant\SocialWork;
use App\Models\User;
use Illuminate\Http\Request;

class SocialWorkController extends Controller
{
    public function show(Request $request, User $user, SocialWork $social_work)
    {
        return ResourceOKResponse::response(new Resource($social_work));
    }

    public function download(Request $request, User $user, SocialWork $social_work)
    {
        return JobFileService::downloadSocialWork($social_work);
    }

    public function approve(ApproveRequest $request, User $user, SocialWork $social_work)
    {
        JobService::approve($request, $social_work->job());
        return OKResponse::response();
    }

    public function reject(RejectRequest $request, User $user, SocialWork $social_work)
    {
        JobService::reject($request, $social_work->job());
        return OKResponse::response();
    }

    public function restore(Request $request, User $user, SocialWork $social_work)
    {
        $social_work->trashed_job->restore();
        return OKResponse::response();
    }

    public function index(ListRequest $request)
    {
        $paginated = SocialWorkService::list_all($request);
        $items = ItemListResource::collection($paginated->items);

        return OKResponse::response([
            'items' => $items,
            'total' => $paginated->total,
        ]);
    }

    public function index_deleted(ListRequest $request)
    {
        $paginated = SocialWorkService::list_all_deleted($request);
        $items = DeletedItemListResource::collection($paginated->items);

        return OKResponse::response([
            'items' => $items,
            'total' => $paginated->total,
        ]);
    }
}
