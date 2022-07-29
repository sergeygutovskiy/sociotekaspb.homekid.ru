<?php

namespace App\Http\Requests\Client\Company;

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
        return [
            'name' => 'required',
            'full_name' => 'required',

            'phone' => 'required',
            'email' => 'required',
            'site' => 'required',

            'owner' => 'required',
            'responsible' => 'required',
            'responsible_phone' => 'required',

            'organization_type_id' => 'required|numeric|exists:dictionaries,id',
            'district_id' => 'required|numeric|exists:dictionaries,id',
            
            'education_license' => 'array|size:3|nullable|present',
            'education_license.number' => 'required_with:education_license|numeric',
            'education_license.date' => 'required_with:education_license|date_format:d.m.Y',
            'education_license.type' => 'required_with:education_license',

            'medical_license' => 'array|size:2|nullable|present',
            'medical_license.number' => 'required_with:medical_license|numeric',
            'medical_license.date' => 'required_with:medical_license|date_format:d.m.Y',
            
            'is_has_innovative_platform' => 'required|boolean'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(BadValidationErrorResponse::response($validator->errors()));
    }
}
