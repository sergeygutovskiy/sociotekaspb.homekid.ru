<?php

namespace App\Http\Services\Admin;

use App\Enums\JobStatus;
use App\Http\Requests\Admin\Job\ApproveRequest;
use App\Http\Requests\Admin\Job\RejectRequest;

class JobService
{
    public static function approve(ApproveRequest $request, $job)
    {
        $is_favorite = $request->validated('is_favorite');

        $job->update([
            'is_favorite' => $is_favorite,
            'status' => JobStatus::ACCEPTED,
        ]);
    }

    public static function reject(RejectRequest $request, $job)
    {
        $comment = $request->validated('comment');

        $job->update([
            'rejected_status_description' => $comment,
            'is_favorite' => false,
            'status' => JobStatus::REJECTED,
        ]);
    } 
}