<?php

namespace App\Models\Job\Variant;

use App\Models\Dictionary;
use App\Models\Job\Variant\Traits\Fields\HasImplementationLevelField;
use App\Models\Job\Variant\Traits\Fields\HasNeedRecognitionsField;
use App\Models\Job\Variant\Traits\Fields\HasPublicWorksField;
use App\Models\Job\Variant\Traits\Fields\HasServicesField;
use App\Models\Job\Variant\Traits\ImplementsJob;
use Database\Factories\Job\SocialProjectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class SocialProject extends Model
{
    use HasFactory;

    use ImplementsJob;
    use HasImplementationLevelField,
        HasPublicWorksField,
        HasServicesField,
        HasNeedRecognitionsField
    ;

    protected $fillable = [
        'participant',
        'implementation_period',
        'implementation_level_id',
        'public_work_ids',
        'service_type_ids',
        'service_name_ids',
        'need_recognition_ids',
    ];

    protected $casts = [
        'participant' => 'array',
        'public_work_ids' => 'array',
        'service_type_ids' => 'array',
        'service_name_ids' => 'array',
        'need_recognition_ids' => 'array',
    ];

    protected static function newFactory()
    {
        return SocialProjectFactory::new();
    }

    public function scopeOptionalIsParticipant(Builder $query, ?bool $is_participant)
    {
        if ( is_null($is_participant) ) return $query;
        return $is_participant
            ? $query->whereNot('participant', null)
            : $query->where('participant', null)
        ;
    }
}
