<?php

namespace App\Http\Validators\Client\Job\Variant\Methodology;

use App\Http\Validators\Validator;

class ListValidator extends Validator
{
    public static function rules()
    {
        return [
            'filter_direction_id' => ['sometimes', 'integer'],
            'filter_application_period_id' => ['sometimes', 'integer'],
            'filter_prevalence_id' => ['sometimes', 'integer'],

            'filter_is_effectiveness_study' => ['sometimes', 'boolean'],

            'filter_service_type_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_service_name_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_public_work_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
        ];
    }
}
