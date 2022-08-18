<?php

namespace App\Http\Controllers\Client\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Job\SocialProject\ListRequest;
use App\Http\Requests\Client\Job\SocialProject\StoreRequest;
use App\Http\Requests\Client\Job\SocialProject\UpdateRequest;
use App\Http\Resources\Client\Job\Variant\SocialProject\ItemListResource;
use App\Http\Resources\Client\Job\Variant\SocialProject\Resource;
use App\Http\Responses\Auth\AccessDeniedErrorResponse;
use App\Http\Responses\OKResponse;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\Client\File\JobFileService;
use App\Http\Services\Client\Job\JobService;
use App\Http\Services\Client\Job\Variant\SocialProjectService;
use App\Models\Job\Variant\SocialProject;
use App\Models\User;
use Illuminate\Http\Request;

class SocialProjectController extends Controller
{
    public function store(StoreRequest $request, User $user)
    {
        if ( $request->user()->cannot('create', $user) ) return AccessDeniedErrorResponse::response();

        $job = JobService::create_job($request, $user);
        $social_project = $job->social_project()->create($request->validated('info'));

        return OKResponse::response([
            'social_project' => [ 'id' => $social_project->id ],
        ]);
    }

    public function show(Request $request, User $user, SocialProject $social_project)
    {
        if ( $request->user()->cannot('view', $user) ) return AccessDeniedErrorResponse::response();
        return ResourceOKResponse::response(new Resource($social_project));
    }

    public function update(UpdateRequest $request, User $user, SocialProject $social_project)
    {
        if ( $request->user()->cannot('update', $user) ) return AccessDeniedErrorResponse::response();

        JobService::update_job($request, $social_project->job);
        $social_project->update($request->validated()['info']);

        return OKResponse::response();
    }

    public function index(ListRequest $request, User $user)
    {
        if ( $request->user()->cannot('list', $user) ) return AccessDeniedErrorResponse::response();

        $paginated = SocialProjectService::list_by_user($request, $user);
        $items = ItemListResource::collection($paginated->items);

        return OKResponse::response([
            'items' => $items,
            'total' => $paginated->total,
        ]);
    }

    public function delete(Request $request, User $user, SocialProject $social_project)
    {
        if ( $request->user()->cannot('delete', $user) ) return AccessDeniedErrorResponse::response();

        $social_project->job->delete();
        return OKResponse::response();
    }

    public function download(Request $request, User $user, SocialProject $social_project)
    {
        if ( $request->user()->cannot('download', $user) ) return AccessDeniedErrorResponse::response();

        return JobFileService::downloadSocialProject($social_project);
    }
}
