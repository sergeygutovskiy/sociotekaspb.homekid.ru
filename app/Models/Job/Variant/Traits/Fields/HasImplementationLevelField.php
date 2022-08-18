<?php

namespace App\Models\Job\Variant\Traits\Fields;

use App\Models\Dictionary;
use Illuminate\Database\Eloquent\Builder;

trait HasImplementationLevelField
{
    public function implementation_level()
    {
        return $this->belongsTo(Dictionary::class, 'implementation_level_id');
    }

    public function scopeOptionalHasImplementationLevel(Builder $query, ?int $implementation_level_id)
    {
        if ( is_null($implementation_level_id) ) return $query;
        return $query->where('implementation_level_id', $implementation_level_id);
    }
}