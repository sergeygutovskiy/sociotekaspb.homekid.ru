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
            'status' => JobStatus::ACCEPTED,
            'rejected_status_description' => null,
            'is_favorite' => $is_favorite,
        ]);

        $job->update([ 'rating' => $job->get()->first()->rating_expanded->count ]);
    }

    public static function reject(RejectRequest $request, $job)
    {
        $comment = $request->validated('comment');

        $job->update([
            'status' => JobStatus::REJECTED,
            'rejected_status_description' => $comment,
            'is_favorite' => false,
        ]);

        $job->update([ 'rating' => $job->get()->first()->rating_expanded->count ]);
    } 
}