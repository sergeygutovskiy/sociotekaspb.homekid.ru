<?php

namespace App\Models\Job\Variant\Traits\Fields;

use App\Models\Dictionary;
use Illuminate\Database\Eloquent\Builder;

trait HasApplicationPeriodField
{
    public function application_period()
    {
        return $this->belongsTo(Dictionary::class, 'application_period_id');
    }

    public function scopeOptionalHasApplicationPeriod(Builder $query, ?int $application_period_id)
    {
        if ( is_null($application_period_id) ) return $query;
        return $query->where('application_period_id', $application_period_id);
    }
}