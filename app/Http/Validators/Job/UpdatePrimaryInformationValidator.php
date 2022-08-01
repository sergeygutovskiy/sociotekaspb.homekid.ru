<?php

namespace App\Http\Validators\Job;

use App\Http\Validators\Validator;

class UpdatePrimaryInformationValidator extends Validator
{
    public static function rules()
    {
        return [
            'primary.name' => ['required', 'string'],
            'primary.annotation' => ['required', 'string'],
            'primary.objectives' => ['required', 'string'],
            'primary.purpose' => ['required', 'string'],
            
            'primary.payment_method_id' => ['required', 'integer', 'exists:dictionaries,id'],
            
            'primary.partnership' => ['array', 'size:1', 'nullable', 'present'],
            'primary.partnership.description' => ['required_with:primary.partnership', 'string'],

            'primary.volunteer_id' => ['required', 'integer', 'exists:dictionaries,id'],

            'primary.needy_category_ids' => ['array', 'present'],
            'primary.needy_category_ids.*' => ['required', 'integer', 'exists:dictionaries,id'],
            'primary.needy_category_target_group_ids' => ['array', 'present'],
            'primary.needy_category_target_group_ids.*' => ['required', 'integer', 'exists:dictionaries,id'],

            'primary.social_service_ids' => ['array', 'present'],
            'primary.social_service_ids.*' => ['required', 'integer', 'exists:dictionaries,id'],

            'primary.qualitative_results' => ['required', 'string'],
            'primary.social_results' => ['required', 'string'],
            'primary.replicability' => ['present', 'nullable', 'string'],

            'primary.approbation' => ['array', 'size:1', 'nullable', 'present'],
            'primary.approbation.description' => ['required_with:primary.approbation', 'string'],

            'primary.expert_opinion' => ['array', 'size:1', 'nullable', 'present'],
            'primary.expert_opinion.description' => ['required_with:primary.expert_opinion', 'string'],
            'primary.review' => ['array', 'size:1', 'nullable', 'present'],
            'primary.review.description' => ['required_with:primary.review', 'string'],
            'primary.comment' => ['array', 'size:1', 'nullable', 'present'],
            'primary.comment.description' => ['required_with:primary.comment', 'string'],

            'primary.video' => ['present', 'nullable'],
            'primary.required_resources_description' => ['required', 'string'],

            'primary.photo_file_id' => ['integer', 'exists:user_files,id', 'nullable'],
            'primary.gallery_file_ids' => ['array', 'present'],
            'primary.gallery_file_ids.*' => ['integer', 'exists:user_files,id', 'nullable'],

            'primary.is_best_practice' => ['boolean'],
            'primary.is_remote_format_possible' => ['boolean'],
        ];
    }
}