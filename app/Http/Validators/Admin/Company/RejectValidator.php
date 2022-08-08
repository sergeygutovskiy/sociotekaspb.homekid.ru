<?php

namespace App\Http\Validators\Admin\Company;

use App\Http\Validators\Validator;

class RejectValidator extends Validator
{
    public static function rules()
    {
        return [
           'comment' => ['required', 'string'],
        ];
    }
}