<?php

namespace App\Models\Job\Variant\Traits\Fields;

use App\Models\Dictionary;
use Illuminate\Database\Eloquent\Builder;

trait HasPrevalenceField
{
    public function prevalence()
    {
        return $this->belongsTo(Dictionary::class, 'prevalence_id');
    }

    public function scopeOptionalHasPrevalence(Builder $query, ?int $prevalence_id)
    {
        if ( is_null($prevalence_id) ) return $query;
        return $query->where('prevalence_id', $prevalence_id);
    }
}