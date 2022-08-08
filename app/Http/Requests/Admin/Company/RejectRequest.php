<?php

namespace App\Http\Requests\Admin\Company;

use App\Http\Responses\Validation\BadValidationErrorResponse;
use App\Http\Validators\Admin\Company\RejectValidator;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RejectRequest extends FormRequest
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
            [],
            RejectValidator::rules(),
        );
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(BadValidationErrorResponse::response($validator->errors()));
    }
}
