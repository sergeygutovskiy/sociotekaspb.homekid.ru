<?php

namespace App\Http\Controllers\Client\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Job\Club\ListRequest;
use App\Http\Requests\Client\Job\Club\StoreRequest;
use App\Http\Requests\Client\Job\Club\UpdateRequest;
use App\Http\Resources\Admin\Job\Variant\Club\ItemListResource;
use App\Http\Resources\Admin\Job\Variant\Club\Resource;
use App\Http\Responses\Auth\AccessDeniedErrorResponse;
use App\Http\Responses\OKResponse;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\Client\File\JobFileService;
use App\Http\Services\Client\Job\JobService;
use App\Http\Services\Client\Job\Variant\ClubService;
use App\Models\Job\Variant\Club;
use App\Models\User;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function store(StoreRequest $request, User $user)
    {
        if ( $request->user()->cannot('create', $user) ) return AccessDeniedErrorResponse::response();

        $job = JobService::create_job($request, $user);
        $club = $job->club()->create($request->validated('info'));

        return OKResponse::response([
            'club' => [ 'id' => $club->id ],
        ]);
    }

    public function show(Request $request, User $user, Club $club)
    {
        if ( $request->user()->cannot('view', $user) ) return AccessDeniedErrorResponse::response();
        return ResourceOKResponse::response(new Resource($club));
    }

    public function update(UpdateRequest $request, User $user, Club $club)
    {
        if ( $request->user()->cannot('update', $user) ) return AccessDeniedErrorResponse::response();

        JobService::update_job($request, $club->job);
        $club->update($request->validated()['info']);

        return OKResponse::response();
    }

    public function index(ListRequest $request, User $user)
    {
        if ( $request->user()->cannot('list', $user) ) return AccessDeniedErrorResponse::response();

        $paginated = ClubService::list_by_user($request, $user);
        $items = ItemListResource::collection($paginated->items);

        return OKResponse::response([
            'items' => $items,
            'total' => $paginated->total,
        ]);
    }

    public function delete(Request $request, User $user, Club $club)
    {
        if ( $request->user()->cannot('delete', $user) ) return AccessDeniedErrorResponse::response();

        $club->job->delete();
        return OKResponse::response();
    }

    public function download(Request $request, User $user, Club $club)
    {
        if ( $request->user()->cannot('download', $user) ) return AccessDeniedErrorResponse::response();

        return JobFileService::downloadClub($club);
    }
}
