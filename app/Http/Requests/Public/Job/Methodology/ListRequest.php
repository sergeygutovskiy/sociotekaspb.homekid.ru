<?php

namespace App\Http\Requests\Public\Job\Methodology;

use App\Http\Responses\Validation\BadValidationErrorResponse;
use App\Http\Validators\Public\Job\ApprovedListValidator;
use App\Http\Validators\Public\Job\Variant\Methodology\ListValidator;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ListRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return array_merge(
            ApprovedListValidator::rules(),
            ListValidator::rules(),
        );
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(BadValidationErrorResponse::response($validator->errors()));
    }
}
