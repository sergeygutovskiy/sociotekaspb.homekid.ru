<?php

namespace App\Http\Requests\Client\Job\SocialProject;

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
                'info.participant' => ['array', 'size:1', 'nullable', 'present'],
                'info.participant.description' => ['required_with:info.participant', 'string'],

                'info.implementation_period' => ['required', 'string'],
                'info.implementation_level_id' => ['required', 'integer', 'exists:dictionaries,id'],

                'info.public_work_ids' => ['array', 'present'],
                'info.public_work_ids.*' => ['required', 'integer', 'exists:dictionaries,id'],

                'info.service_type_ids' => ['array', 'present'],
                'info.service_type_ids.*' => ['required', 'integer', 'exists:dictionaries,id'],

                'info.service_name_ids' => ['array', 'present'],
                'info.service_name_ids.*' => ['required', 'integer', 'exists:dictionaries,id'],

                'info.need_recognition_ids' => ['array', 'present'],
                'info.need_recognition_ids.*' => ['required', 'integer', 'exists:dictionaries,id'],
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
