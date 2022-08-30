<?php

namespace App\Http\Validators\Public\Job\Variant\EduProgram;

use App\Http\Validators\Validator;

class ListValidator extends Validator
{
    public static function rules()
    {
        return [
            'filter_direction_id' => ['sometimes', 'integer'],
        ];
    }
}