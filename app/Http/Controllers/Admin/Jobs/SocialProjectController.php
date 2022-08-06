<?php

namespace App\Http\Controllers\Admin\Jobs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Job\ApproveRequest;
use App\Http\Requests\Admin\Job\RejectRequest;
use App\Http\Responses\OKResponse;
use App\Http\Services\Admin\JobService;
use App\Models\Job\SocialProject;
use App\Models\User;

class SocialProjectController extends Controller
{
    public function approve(ApproveRequest $request, User $user, $id)
    {
        $social_project = SocialProject::findOrFailByUserId($user->id, $id);
        JobService::approve($request, $social_project->job());

        return OKResponse::response();
    }

    public function reject(RejectRequest $request, User $user, $id)
    {
        $social_project = SocialProject::findOrFailByUserId($user->id, $id);
        JobService::reject($request, $social_project->job());

        return OKResponse::response();
    }
}
