<?php

namespace App\Models\Job\Variant\Traits\Fields;

use App\Models\Dictionary;
use Illuminate\Database\Eloquent\Builder;

trait HasConductingClassesFormField
{
    public function conducting_classes_form()
    {
        return $this->belongsTo(Dictionary::class, 'conducting_classes_form_id');
    }

    public function scopeOptionalHasConductingClasses(Builder $query, ?int $conducting_classes_form_id)
    {
        if ( is_null($conducting_classes_form_id) ) return $query;
        return $query->where('conducting_classes_form_id', $conducting_classes_form_id);
    }
}