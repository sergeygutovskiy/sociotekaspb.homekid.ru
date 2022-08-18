<?php

namespace App\Models\Job\Variant\Traits\Fields;

use App\Models\Dictionary;
use Illuminate\Database\Eloquent\Builder;

trait HasNeedRecognitionsField
{
    public function need_recognitions()
    {
        return Dictionary::whereIn('id', $this->need_recognition_ids)->get();
    }

    public function scopeOptionalHasNeedRecognitions(Builder $query, ?array $ids)
    {
        if ( is_null($ids) ) return $query;
        return $query->whereJsonContains('need_recognition_ids', $ids);
    }
}