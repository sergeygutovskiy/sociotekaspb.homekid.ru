<?php

namespace App\Http\Controllers\Admin\Jobs;

use App\Enums\JobStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Job\ApproveRequest;
use App\Http\Requests\Admin\Job\RejectRequest;
use App\Http\Responses\OKResponse;
use App\Models\Job\SocialProject;
use App\Models\User;

class SocialProjectController extends Controller
{
    public function approve(ApproveRequest $request, User $user, $id)
    {
        $social_project = SocialProject::whereHas('job', fn($q) => $q->where('user_id', $user->id))->findOrFail($id);
        $is_favorite = $request->validated('is_favorite');

        $social_project->job()->update([
            'is_favorite' => $is_favorite,
            'status' => JobStatus::ACCEPTED,
        ]);

        return OKResponse::response();
    }

    public function reject(RejectRequest $request, User $user, $id)
    {
        $social_project = SocialProject::whereHas('job', fn($q) => $q->where('user_id', $user->id))->findOrFail($id);
        $comment = $request->validated('comment');

        $social_project->job()->update([
            'rejected_status_description' => $comment,
            'is_favorite' => false,
            'status' => JobStatus::REJECTED,
        ]);

        return OKResponse::response();
    }
}
