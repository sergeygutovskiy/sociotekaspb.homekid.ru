<?php

namespace App\Http\Validators\Job;

use App\Http\Validators\Validator;

class StoreContactsValidator extends Validator
{
    public static function rules()
    {
        return [
            'contacts.fio' => ['required'],
            'contacts.email' => ['required'],
            'contacts.phone' => ['required'],
        ];
    }
}