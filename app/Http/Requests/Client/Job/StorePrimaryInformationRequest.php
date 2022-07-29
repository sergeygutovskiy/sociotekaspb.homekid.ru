<?php

namespace App\Http\Requests\Client\Job;

use Illuminate\Foundation\Http\FormRequest;

class StorePrimaryInformationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'annotation' => ['required'],
            'objectives' => ['required'],
            'purpose' => ['required'],
            
            'payment_method_id' => ['required', 'integer', 'exists:dicionaries'],
            
            'partnership' => ['array', 'size:1', 'nullable', 'present'],
            'partnership.description' => ['required_with:partnership'],

            'volunteer_id' => ['required', 'integer', 'exists:dicionaries'],

            'needy_category_ids' => ['array'],
            'needy_category_ids.*' => ['required', 'integer', 'exists:dicionaries'],
            'needy_category_target_group_ids' => ['array'],
            'needy_category_target_group_ids.*' => ['required', 'integer', 'exists:dicionaries'],

            'social_service_ids' => ['array'],
            'social_service_ids.*' => ['required', 'integer', 'exists:dicionaries'],

            'qualitative_results' => ['required'],
            'social_results' => ['required'],
            'replicability' => ['required', 'nullable'],

            'approbation' => ['array', 'size:1', 'nullable', 'present'],
            'approbation.description' => ['required_with:approbation'],

            'expert_opinion' => ['array', 'size:1', 'nullable', 'present'],
            'expert_opinion.description' => ['required_with:expert_opinion'],
            'review' => ['array', 'size:1', 'nullable', 'present'],
            'review.description' => ['required_with:review'],
            'comment' => ['array', 'size:1', 'nullable', 'present'],
            'comment.description' => ['required_with:comment'],

            'video' => ['required', 'nullable'],
            'required_resources_description' => ['required'],

            'photo' => ['required', 'nullable'],
            'gallery' => ['array'],
            'gallery.*' => ['required'],

            'is_best_practice' => ['boolean'],
            'is_remote_format_possible' => ['boolean'],
        ];
    }
}
