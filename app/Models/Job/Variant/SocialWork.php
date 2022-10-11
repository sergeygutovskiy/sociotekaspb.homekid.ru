<?php

namespace App\Models\Job\Variant;

use App\Models\Job\Variant\Traits\Fields\HasConductingClassesFormField;
use App\Models\Job\Variant\Traits\Fields\HasDirectionField;
use App\Models\Job\Variant\Traits\Fields\HasProgramTypeField;
use App\Models\Job\Variant\Traits\Fields\HasPublicWorksField;
use App\Models\Job\Variant\Traits\Fields\HasServicesField;
use App\Models\Job\Variant\Traits\ImplementsJob;
use Database\Factories\Job\Variant\SocialWorkFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialWork extends Model
{
    use HasFactory;
    use ImplementsJob,
        HasProgramTypeField,
        HasDirectionField,
        HasConductingClassesFormField,
        HasPublicWorksField,
        HasServicesField
        ;

    protected $fillable = [
        'program_type_id',
        'direction_id',
        'conducting_classes_form_id',
        'public_work_ids',
        'service_type_ids',
        'service_name_ids',
    ];

    protected $casts = [
        'public_work_ids' => 'array',
        'service_type_ids' => 'array',
        'service_name_ids' => 'array',
    ];

    protected static function newFactory()
    {
        return SocialWorkFactory::new();
    }
}
