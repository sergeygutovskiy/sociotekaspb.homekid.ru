<?php

namespace App\Http\Validators\Job;

use App\Http\Validators\Validator;

class ApproveValidator extends Validator
{
    public static function rules()
    {
        return [
           'is_favorite' => ['required', 'boolean'],
        ];
    }
}