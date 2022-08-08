<?php

namespace App\Http\Controllers\Admin\Jobs;

use App\Enums\JobVariant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Job\ApproveRequest;
use App\Http\Requests\Admin\Job\RejectRequest;
use App\Http\Requests\Client\Job\SocialProject\ListRequest;
use App\Http\Resources\Admin\Job\SocialProjectItemListResource;
use App\Http\Services\Admin\JobService as AdminJobService;
use App\Http\Services\Client\JobService as ClientJobService;
use App\Http\Responses\OKResponse;
use App\Models\Job\SocialProject;
use App\Models\User;

class SocialProjectController extends Controller
{
    public function approve(ApproveRequest $request, User $user, $id)
    {
        $social_project = SocialProject::findOrFailByUserId($user->id, $id);
        AdminJobService::approve($request, $social_project->job());

        return OKResponse::response();
    }

    public function reject(RejectRequest $request, User $user, $id)
    {
        $social_project = SocialProject::findOrFailByUserId($user->id, $id);
        AdminJobService::reject($request, $social_project->job());

        return OKResponse::response();
    }

    public function index(ListRequest $request)
    {
        $data = ClientJobService::list($request, JobVariant::SOCIAL_PROJECT);

        $total = $data['total'];
        $items = SocialProjectItemListResource::collection($data['items']->map(fn($job) => $job->social_project));

        return OKResponse::response([
            'items' => $items,
            'total' => $total,
        ]);
    }
}
