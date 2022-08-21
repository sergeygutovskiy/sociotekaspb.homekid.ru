<?php

namespace App\Http\Controllers\Admin\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Job\ApproveRequest;
use App\Http\Requests\Admin\Job\RejectRequest;
use App\Http\Requests\Client\Job\Club\ListRequest;
use App\Http\Resources\Admin\Job\Variant\Club\DeletedItemListResource;
use App\Http\Resources\Admin\Job\Variant\Club\ItemListResource;
use App\Http\Resources\Admin\Job\Variant\Club\Resource;
use App\Http\Responses\OKResponse;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\Admin\JobService;
use App\Http\Services\Client\File\JobFileService;
use App\Http\Services\Client\Job\Variant\ClubService;
use App\Models\Job\Variant\Club;
use App\Models\User;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function show(Request $request, User $user, Club $club)
    {
        return ResourceOKResponse::response(new Resource($club));
    }

    public function download(Request $request, User $user, Club $club)
    {
        return JobFileService::downloadClub($club);
    }

    public function approve(ApproveRequest $request, User $user, Club $club)
    {
        JobService::approve($request, $club->job());
        return OKResponse::response();
    }

    public function reject(RejectRequest $request, User $user, Club $club)
    {
        JobService::reject($request, $club->job());
        return OKResponse::response();
    }

    public function restore(Request $request, User $user, Club $club)
    {
        $club->trashed_job->restore();
        return OKResponse::response();
    }

    public function index(ListRequest $request)
    {
        $paginated = ClubService::list_all($request);
        $items = ItemListResource::collection($paginated->items);

        return OKResponse::response([
            'items' => $items,
            'total' => $paginated->total,
        ]);
    }

    public function index_deleted(ListRequest $request)
    {
        $paginated = ClubService::list_all_deleted($request);
        $items = DeletedItemListResource::collection($paginated->items);

        return OKResponse::response([
            'items' => $items,
            'total' => $paginated->total,
        ]);
    }
}
