<?php

namespace App\Http\Validators\Job;

use App\Http\Validators\Validator;

class RejectValidator extends Validator
{
    public static function rules()
    {
        return [
           'comment' => ['string', 'nullable'],
        ];
    }
}