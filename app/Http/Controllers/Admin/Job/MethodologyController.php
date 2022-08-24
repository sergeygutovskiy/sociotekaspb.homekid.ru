<?php

namespace App\Http\Controllers\Admin\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Job\ApproveRequest;
use App\Http\Requests\Admin\Job\RejectRequest;
use App\Http\Requests\Client\Job\Methodology\ListRequest;
use App\Http\Resources\Admin\Job\Variant\Methodology\DeletedItemListResource;
use App\Http\Resources\Admin\Job\Variant\Methodology\ItemListResource;
use App\Http\Resources\Admin\Job\Variant\Methodology\Resource;
use App\Http\Responses\OKResponse;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\Admin\JobService;
use App\Http\Services\Client\File\JobFileService;
use App\Http\Services\Client\Job\Variant\MethodologyService;
use App\Models\Job\Variant\Methodology;
use App\Models\User;
use Illuminate\Http\Request;

class MethodologyController extends Controller
{
    public function show(Request $request, User $user, Methodology $methodology)
    {
        return ResourceOKResponse::response(new Resource($methodology));
    }

    public function download(Request $request, User $user, Methodology $methodology)
    {
        return JobFileService::downloadMethodology($methodology);
    }

    public function approve(ApproveRequest $request, User $user, Methodology $methodology)
    {
        JobService::approve($request, $methodology->job());
        return OKResponse::response();
    }

    public function reject(RejectRequest $request, User $user, Methodology $methodology)
    {
        JobService::reject($request, $methodology->job());
        return OKResponse::response();
    }

    public function restore(Request $request, User $user, Methodology $methodology)
    {
        $methodology->trashed_job->restore();
        return OKResponse::response();
    }

    public function index(ListRequest $request)
    {
        $paginated = MethodologyService::list_all($request);
        $items = ItemListResource::collection($paginated->items);

        return OKResponse::response([
            'items' => $items,
            'total' => $paginated->total,
        ]);
    }

    public function index_deleted(ListRequest $request)
    {
        $paginated = MethodologyService::list_all_deleted($request);
        $items = DeletedItemListResource::collection($paginated->items);

        return OKResponse::response([
            'items' => $items,
            'total' => $paginated->total,
        ]);
    }
}
