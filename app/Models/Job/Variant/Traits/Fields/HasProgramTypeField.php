<?php

namespace App\Models\Job\Variant\Traits\Fields;

use App\Models\Dictionary;
use Illuminate\Database\Eloquent\Builder;

trait HasProgramTypeField
{
    public function program_type()
    {
        return $this->belongsTo(Dictionary::class, 'program_type_id');
    }

    public function scopeOptionalHasProgramType(Builder $query, ?int $program_type_id)
    {
        if ( is_null($program_type_id) ) return $query;
        return $query->where('program_type_id', $program_type_id);
    }
}