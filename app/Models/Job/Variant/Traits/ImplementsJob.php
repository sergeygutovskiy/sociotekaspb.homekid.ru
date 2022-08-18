<?php

namespace App\Models\Job\Variant\Traits;

use App\Models\Job\Job;

trait ImplementsJob
{
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function trashed_job()
    {
        return $this->job()->withTrashed();
    }

    public static function findOrFailByUser(int $id, int $user_id): self
    {
        return self::whereHas('job', fn($q) => $q->where('user_id', $user_id))
            ->findOrFail($id);
    }

    public static function findDeletedOrFailByUser(int $id, int $user_id): self
    {
        return self::whereHas('job', fn($q) => $q->onlyTrashed()->where('user_id', $user_id))
            ->findOrFail($id);
    }

    public static function findOptionalDeletedOrFailByUser(int $id, int $user_id): self
    {
        return self::whereHas('job', fn($q) => $q->withTrashed()->where('user_id', $user_id))
            ->findOrFail($id);
    }
}
