<?php

namespace App\Http\Controllers\Client\Jobs;

use App\Enums\JobVariant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Job\SocialProject\ListRequest;
use App\Http\Requests\Client\Job\SocialProject\StoreRequest;
use App\Http\Requests\Client\Job\SocialProject\UpdateRequest;
use App\Http\Resources\Client\Job\SocialProjectResource;
use App\Http\Resources\Client\Job\SocialProjectItemListResource;
use App\Http\Responses\OKResponse;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\Client\JobService;
use App\Models\Job\SocialProject;
use App\Models\User;

class SocialProjectController extends Controller
{
    public function store(StoreRequest $request, User $user)
    {
        $job = JobService::create_job($request, $user);
        $social_project = $job->social_project()->create($request->validated('info'));

        return OKResponse::response([
            'social_project' => [ 'id' => $social_project->id ],
        ]);
    }

    public function show(User $user, int $id)
    {
        $social_project = SocialProject::findOrFailByUserId($user->id, $id);
        return ResourceOKResponse::response(new SocialProjectResource($social_project));
    }

    public function update(UpdateRequest $request, User $user, int $id)
    {
        $social_project = SocialProject::findOrFailByUserId($user->id, $id);

        JobService::update_job($request, $social_project->job);
        $social_project->update($request->validated()['info']);

        return OKResponse::response();
    }

    public function index(ListRequest $request, User $user)
    {
        $data = JobService::list($request, $user, JobVariant::SOCIAL_PROJECT);

        $total = $data['total'];
        $items = SocialProjectItemListResource::collection($data['items']->map(fn($job) => $job->social_project));

        return OKResponse::response([
            'items' => $items,
            'total' => $total,
        ]);
    }
}
