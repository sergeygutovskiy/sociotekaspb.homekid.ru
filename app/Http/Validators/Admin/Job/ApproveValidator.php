<?php

namespace App\Http\Validators\Admin\Job;

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