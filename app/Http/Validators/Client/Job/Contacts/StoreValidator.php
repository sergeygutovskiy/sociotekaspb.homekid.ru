<?php

namespace App\Http\Validators\Client\Job\Contacts;

use App\Http\Validators\Validator;

class StoreValidator extends Validator
{
    public static function rules()
    {
        return [
            'contacts.fio' => ['required', 'string'],
            'contacts.email' => ['required', 'string'],
            'contacts.phone' => ['required', 'string'],
        ];
    }
}