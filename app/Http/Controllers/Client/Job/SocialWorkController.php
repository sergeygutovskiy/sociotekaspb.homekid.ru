<?php

namespace App\Http\Controllers\Client\Job;

use App\Enums\JobVariant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Job\SocialWork\ListRequest;
use App\Http\Requests\Client\Job\SocialWork\StoreRequest;
use App\Http\Requests\Client\Job\SocialWork\UpdateRequest;
use App\Http\Resources\Client\Job\Variant\SocialWork\ItemListResource;
use App\Http\Resources\Client\Job\Variant\SocialWork\Resource;
use App\Http\Responses\Auth\AccessDeniedErrorResponse;
use App\Http\Responses\OKResponse;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\Client\File\JobFileService;
use App\Http\Services\Client\Job\JobService;
use App\Http\Services\Client\Job\Variant\SocialWorkService;
use App\Models\Job\Variant\SocialWork;
use App\Models\User;
use Illuminate\Http\Request;

class SocialWorkController extends Controller
{
    public function store(StoreRequest $request, User $user)
    {
        if ( $request->user()->cannot('create', $user) ) return AccessDeniedErrorResponse::response();

        $job = JobService::create_job($request, $user, JobVariant::SOCIAL_WORK);
        $social_work = $job->social_work()->create($request->validated('info'));
        $job->update(['variant_id' => $social_work->id]);

        return OKResponse::response([
            'social_work' => [ 'id' => $social_work->id ],
        ]);
    }

    public function show(Request $request, User $user, SocialWork $social_work)
    {
        if ( $request->user()->cannot('view', $user) ) return AccessDeniedErrorResponse::response();
        return ResourceOKResponse::response(new Resource($social_work));
    }

    public function update(UpdateRequest $request, User $user, SocialWork $social_work)
    {
        if ( $request->user()->cannot('update', $user) ) return AccessDeniedErrorResponse::response();

        JobService::update_job($request, $social_work->job);
        $social_work->update($request->validated()['info']);

        return OKResponse::response();
    }

    public function index(ListRequest $request, User $user)
    {
        if ( $request->user()->cannot('list', $user) ) return AccessDeniedErrorResponse::response();

        $paginated = SocialWorkService::list_by_user($request, $user);
        $items = ItemListResource::collection($paginated->items);

        return OKResponse::response([
            'items' => $items,
            'total' => $paginated->total,
        ]);
    }

    public function delete(Request $request, User $user, SocialWork $social_work)
    {
        if ( $request->user()->cannot('delete', $user) ) return AccessDeniedErrorResponse::response();

        $social_work->job->delete();
        return OKResponse::response();
    }

    public function download(Request $request, User $user, SocialWork $social_work)
    {
        if ( $request->user()->cannot('download', $user) ) return AccessDeniedErrorResponse::response();

        return JobFileService::downloadSocialWork($social_work);
    }
}
