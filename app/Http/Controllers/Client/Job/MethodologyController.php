<?php

namespace App\Http\Controllers\Client\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Job\Methodology\ListRequest;
use App\Http\Requests\Client\Job\Methodology\StoreRequest;
use App\Http\Requests\Client\Job\Methodology\UpdateRequest;
use App\Http\Resources\Admin\Job\Variant\Methodology\ItemListResource;
use App\Http\Resources\Admin\Job\Variant\Methodology\Resource;
use App\Http\Responses\Auth\AccessDeniedErrorResponse;
use App\Http\Responses\OKResponse;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\Client\File\JobFileService;
use App\Http\Services\Client\Job\JobService;
use App\Http\Services\Client\Job\Variant\MethodologyService;
use App\Models\Job\Variant\Methodology;
use App\Models\User;
use Illuminate\Http\Request;

class MethodologyController extends Controller
{
    public function store(StoreRequest $request, User $user)
    {
        if ( $request->user()->cannot('create', $user) ) return AccessDeniedErrorResponse::response();

        $job = JobService::create_job($request, $user);
        $club = $job->methodology()->create($request->validated('info'));

        return OKResponse::response([
            'club' => [ 'id' => $club->id ],
        ]);
    }

    public function show(Request $request, User $user, Methodology $methodology)
    {
        if ( $request->user()->cannot('view', $user) ) return AccessDeniedErrorResponse::response();
        return ResourceOKResponse::response(new Resource($methodology));
    }

    public function update(UpdateRequest $request, User $user, Methodology $methodology)
    {
        if ( $request->user()->cannot('update', $user) ) return AccessDeniedErrorResponse::response();

        JobService::update_job($request, $methodology->job);
        $methodology->update($request->validated()['info']);

        return OKResponse::response();
    }

    public function index(ListRequest $request, User $user)
    {
        if ( $request->user()->cannot('list', $user) ) return AccessDeniedErrorResponse::response();

        $paginated = MethodologyService::list_by_user($request, $user);
        $items = ItemListResource::collection($paginated->items);

        return OKResponse::response([
            'items' => $items,
            'total' => $paginated->total,
        ]);
    }

    public function delete(Request $request, User $user, Methodology $methodology)
    {
        if ( $request->user()->cannot('delete', $user) ) return AccessDeniedErrorResponse::response();

        $methodology->job->delete();
        return OKResponse::response();
    }

    public function download(Request $request, User $user, Methodology $methodology)
    {
        if ( $request->user()->cannot('download', $user) ) return AccessDeniedErrorResponse::response();

        return JobFileService::downloadMethodology($methodology);
    }
}
