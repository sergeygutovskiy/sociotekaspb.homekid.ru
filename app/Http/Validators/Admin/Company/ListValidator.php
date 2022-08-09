<?php

namespace App\Http\Validators\Admin\Company;

use App\Http\Validators\Validator;
use Illuminate\Validation\Rule;

class ListValidator extends Validator
{
    public static function rules()
    {
        return [
            'page' => ['required', 'integer', 'min:1'],
            'limit' => ['required', 'integer', 'min:1'],
            'sort_direction' => [
                'sometimes',
                Rule::in([ 'asc', 'desc' ])
            ],
        ];
    }
}