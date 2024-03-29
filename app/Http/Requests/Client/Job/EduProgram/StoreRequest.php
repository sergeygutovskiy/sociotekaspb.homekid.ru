<?php

namespace App\Http\Requests\Client\Job\EduProgram;

use App\Http\Responses\Validation\BadValidationErrorResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
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
            [
                'info.direction_id' => ['required', 'integer', 'exists:dictionaries,id'],
                'info.conducting_classes_form_id' => ['required', 'integer', 'exists:dictionaries,id'],
            ],
            \App\Http\Validators\Client\Job\PrimaryInformation\StoreValidator::rules(),
            \App\Http\Validators\Client\Job\Experience\StoreValidator::rules(),
            \App\Http\Validators\Client\Job\Contacts\StoreValidator::rules(),
            \App\Http\Validators\Client\Job\ReportingPeriods\StoreValidator::rules(),
        );
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(BadValidationErrorResponse::response($validator->errors()));
    }
}
