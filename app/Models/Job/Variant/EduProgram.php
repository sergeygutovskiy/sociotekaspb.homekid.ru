<?php

namespace App\Models\Job\Variant;

use App\Models\Job\Variant\Traits\Fields\HasConductingClassesFormField;
use App\Models\Job\Variant\Traits\Fields\HasDirectionField;
use App\Models\Job\Variant\Traits\ImplementsJob;
use Database\Factories\Job\Variant\EduProgramFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EduProgram extends Model
{
    use HasFactory;

    use ImplementsJob,
        HasDirectionField,
        HasConductingClassesFormField
        ;

    protected $fillable = [
        'direction_id',
        'conducting_classes_form_id',
        'dates_and_mode_of_study',
    ];

    protected static function newFactory()
    {
        return EduProgramFactory::new();
    }
}
