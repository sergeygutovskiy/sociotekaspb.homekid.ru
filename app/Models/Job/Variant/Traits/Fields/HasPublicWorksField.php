<?php

namespace App\Models\Job\Variant\Traits\Fields;

use App\Models\Dictionary;
use Illuminate\Database\Eloquent\Builder;

trait HasPublicWorksField
{
    public function public_works()
    {
        return Dictionary::whereIn('id', $this->public_work_ids)->get();
    }

    public function scopeOptionalHasPublicWorks(Builder $query, ?array $ids)
    {
        if ( is_null($ids) ) return $query;
        return $query->whereJsonContains('public_work_ids', $ids);
    }
}