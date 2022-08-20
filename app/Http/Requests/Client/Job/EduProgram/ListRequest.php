<?php

namespace App\Http\Requests\Client\Job\EduProgram;

use App\Http\Responses\Validation\BadValidationErrorResponse;
use App\Http\Validators\Client\Job\ListValidator;
use App\Http\Validators\Client\Job\Variant\EduProgram\ListValidator as EduProgramListValidator;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return array_merge(
            ListValidator::rules(),
            EduProgramListValidator::rules(),
        );
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(BadValidationErrorResponse::response($validator->errors()));
    }
}
