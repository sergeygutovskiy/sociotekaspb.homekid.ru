<?php

namespace App\Http\Services\Public;

use App\Models\Job\Job;

class JobService
{
    public static function approvedWithApprovedCompany(string $job_variant, int $id)
    {
        return Job::approved()
            ->withApprovedCompany()
            ->whereHas($job_variant, fn($q) => $q->where('id', $id))
            ;
    }

    public static function best(string $job_variant, int $id)
    {
        return Job::approved()
            ->withApprovedCompany()
            ->where('is_favorite', true)
            ->whereHas($job_variant, fn($q) => $q->where('id', $id))
            ;
    }
}
