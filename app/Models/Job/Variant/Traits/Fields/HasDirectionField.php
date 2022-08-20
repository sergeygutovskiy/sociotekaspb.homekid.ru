<?php

namespace App\Models\Job\Variant\Traits\Fields;

use App\Models\Dictionary;
use Illuminate\Database\Eloquent\Builder;

trait HasDirectionField
{
    public function direction()
    {
        return $this->belongsTo(Dictionary::class, 'direction_id');
    }

    public function scopeOptionalHasDirection(Builder $query, ?int $direction_id)
    {
        if ( is_null($direction_id) ) return $query;
        return $query->where('direction_id', $direction_id);
    }
}