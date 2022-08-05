<?php

namespace App\Http\Controllers\Client\Jobs;

use App\Enums\JobVariant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Job\SocialProject\StoreRequest;
use App\Http\Requests\Client\Job\SocialProject\UpdateRequest;
use App\Http\Resources\Client\Job\SocialProjectResource;
use App\Http\Resources\Clinet\Job\SocialProjectItemListResource;
use App\Http\Responses\Auth\UserNotFoundErrorResponse;
use App\Http\Responses\OKResponse;
use App\Http\Responses\Resources\ResourceNotFoundErrorResponse;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\JobService;
use App\Models\Job\SocialProject;
use App\Models\User;
use Illuminate\Http\Request;

class SocialProjectController extends Controller
{
    public function store(StoreRequest $request, int $user_id)
    {
        $user = User::find($user_id);
        if ( !$user ) return UserNotFoundErrorResponse::response();

        $job = JobService::create_job($request, $user);
        $social_project = $job->social_project()->create($request->validated('info'));

        return OKResponse::response([
            'social_project' => [ 'id' => $social_project->id ],
        ]);
    }

    public function show(int $user_id, int $id)
    {
        $user = User::find($user_id);
        if ( !$user ) return UserNotFoundErrorResponse::response();

        $social_project = SocialProject::find($id);
        if ( !$social_project ) return ResourceNotFoundErrorResponse::response();

        return ResourceOKResponse::response(new SocialProjectResource($social_project));
    }

    public function update(UpdateRequest $request, int $user_id, int $id)
    {
        $user = User::find($user_id);
        if ( !$user ) return UserNotFoundErrorResponse::response();

        $social_project = SocialProject::find($id);
        if ( !$social_project ) return ResourceNotFoundErrorResponse::response();

        JobService::update_job($request, $social_project->job);
        $social_project->update($request->validated()['info']);

        return OKResponse::response();
    }

    public function index(Request $request, int $user_id)
    {
        $user = User::find($user_id);
        if ( !$user ) return UserNotFoundErrorResponse::response();

        $data = JobService::list($request, $user, JobVariant::SOCIAL_PROJECT);

        $total = $data['total'];
        $items = SocialProjectItemListResource::collection($data['items']->map(fn($job) => $job->social_project));

        return OKResponse::response([
            'items' => $items,
            'total' => $total,
        ]);
    }
}
