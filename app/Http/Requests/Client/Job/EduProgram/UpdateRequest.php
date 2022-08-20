<?php

namespace App\Http\Requests\Client\Job\EduProgram;

use App\Http\Responses\Validation\BadValidationErrorResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
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
                'info.dates_and_mode_of_study' => ['required', 'string'],
            ],
            \App\Http\Validators\Client\Job\PrimaryInformation\UpdateValidator::rules(),
            \App\Http\Validators\Client\Job\Experience\UpdateValidator::rules(),
            \App\Http\Validators\Client\Job\Contacts\UpdateValidator::rules(),
            \App\Http\Validators\Client\Job\ReportingPeriods\UpdateValidator::rules(),
        );
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(BadValidationErrorResponse::response($validator->errors()));
    }
}
