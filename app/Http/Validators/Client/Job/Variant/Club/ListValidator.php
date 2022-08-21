<?php

namespace App\Http\Validators\Client\Job\Variant\Club;

use App\Http\Validators\Validator;

class ListValidator extends Validator
{
    public static function rules()
    {
        return [
            'filter_service_type_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_service_name_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_public_work_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
        ];
    }
}