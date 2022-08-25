<?php

namespace App\Models\Job\Variant;

use App\Models\Job\Variant\Traits\Fields\HasActivityOrganizationFormIdField;
use App\Models\Job\Variant\Traits\Fields\HasApplicationPeriodField;
use App\Models\Job\Variant\Traits\Fields\HasDirectionField;
use App\Models\Job\Variant\Traits\Fields\HasPrevalenceField;
use App\Models\Job\Variant\Traits\Fields\HasPublicWorksField;
use App\Models\Job\Variant\Traits\Fields\HasServicesField;
use App\Models\Job\Variant\Traits\ImplementsJob;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Methodology extends Model
{
    use HasFactory;
    use ImplementsJob,
        HasDirectionField,
        HasPrevalenceField,
        HasApplicationPeriodField,
        HasActivityOrganizationFormIdField,
        HasServicesField,
        HasPublicWorksField
        ;

    protected $fillable = [
        'direction_id',
        'prevalence_id',
        'activity_organization_form_id',
        'application_period_id',
        'authors',
        'publication_link',
        'effectiveness_study',
        'effectiveness_study_link',
        'realized_cycles',
        'cycle_duration',
        'public_work_ids',
        'service_type_ids',
        'service_name_ids',
    ];

    protected $casts = [
        'public_work_ids' => 'array',
        'service_type_ids' => 'array',
        'service_name_ids' => 'array',
    ];

    public function scopeOptionalIsHasEffectivenessStudy(Builder $query, ?bool $is_has_effectiveness_study)
    {
        if ( is_null($is_has_effectiveness_study) ) return $query;
        return $is_has_effectiveness_study
            ? $query->whereNotNull('effectiveness_study')
            : $query->whereNull('effectiveness_study');
    }
}
