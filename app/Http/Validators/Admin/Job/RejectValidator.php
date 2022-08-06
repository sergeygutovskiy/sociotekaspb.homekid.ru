<?php

namespace App\Http\Validators\Admin\Job;

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