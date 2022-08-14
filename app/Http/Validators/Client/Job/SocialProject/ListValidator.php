<?php

namespace App\Http\Validators\Client\Job\SocialProject;

use App\Http\Validators\Validator;

class ListValidator extends Validator
{
    public static function rules()
    {
        return [
            'filter_service_type_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_service_name_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_public_work_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_need_recognition_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_implementation_level_id' => ['sometimes', 'integer'],
            'filter_is_participant' => ['sometimes', 'boolean'],
        ];
    }
}