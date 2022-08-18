<?php

namespace App\Models\Job\Variant\Traits\Fields;

use App\Models\Dictionary;
use Illuminate\Database\Eloquent\Builder;

trait HasServicesField
{
    public function service_types()
    {
        return Dictionary::whereIn('id', $this->service_type_ids)->get();
    }

    public function service_names()
    {
        return Dictionary::whereIn('id', $this->service_name_ids)->get();
    }

    public function scopeOptionalHasServiceTypes(Builder $query, ?array $ids)
    {
        if ( is_null($ids) ) return $query;
        return $query->whereJsonContains('service_type_ids', $ids);
    }

    public function scopeOptionalHasServiceNames(Builder $query, ?array $ids)
    {
        if ( is_null($ids) ) return $query;
        return $query->whereJsonContains('service_name_ids', $ids);
    }
}