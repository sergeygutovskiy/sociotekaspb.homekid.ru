<?php

namespace App\Models\Job\Variant\Traits;

use App\Models\Job\Job;

trait ImplementsJob
{
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public static function findOrFailByUserId(int $user_id, int $id): self
    {
        return self::whereHas('job', fn($q) => $q->where('user_id', $user_id))->findOrFail($id);
    } 
}
