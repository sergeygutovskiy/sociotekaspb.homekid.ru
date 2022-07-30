<?php

namespace App\Http\Validators\Job;

use App\Http\Validators\Validator;

class StorePrimaryInformationValidator extends Validator
{
    public static function rules()
    {
        return [
            'primary.name' => ['required'],
            'primary.annotation' => ['required'],
            'primary.objectives' => ['required'],
            'primary.purpose' => ['required'],
            
            'primary.payment_method_id' => ['required', 'integer', 'exists:dictionaries,id'],
            
            'primary.partnership' => ['array', 'size:1', 'nullable', 'present'],
            'primary.partnership.description' => ['required_with:primary.partnership'],

            'primary.volunteer_id' => ['required', 'integer', 'exists:dictionaries,id'],

            'primary.needy_category_ids' => ['array', 'present'],
            'primary.needy_category_ids.*' => ['required', 'integer', 'exists:dictionaries,id'],
            'primary.needy_category_target_group_ids' => ['array', 'present'],
            'primary.needy_category_target_group_ids.*' => ['required', 'integer', 'exists:dictionaries,id'],

            'primary.social_service_ids' => ['array', 'present'],
            'primary.social_service_ids.*' => ['required', 'integer', 'exists:dictionaries,id'],

            'primary.qualitative_results' => ['required'],
            'primary.social_results' => ['required'],
            'primary.replicability' => ['present', 'nullable'],

            'primary.approbation' => ['array', 'size:1', 'nullable', 'present'],
            'primary.approbation.description' => ['required_with:primary.approbation'],

            'primary.expert_opinion' => ['array', 'size:1', 'nullable', 'present'],
            'primary.expert_opinion.description' => ['required_with:primary.expert_opinion'],
            'primary.review' => ['array', 'size:1', 'nullable', 'present'],
            'primary.review.description' => ['required_with:primary.review'],
            'primary.comment' => ['array', 'size:1', 'nullable', 'present'],
            'primary.comment.description' => ['required_with:primary.comment'],

            'primary.video' => ['present', 'nullable'],
            'primary.required_resources_description' => ['required'],

            'primary.photo_file_id' => ['integer', 'exists:user_files,id', 'nullable'],
            'primary.gallery_file_ids' => ['array', 'present'],
            'primary.gallery_file_ids.*' => ['integer', 'exists:user_files,id', 'nullable'],

            'primary.is_best_practice' => ['boolean'],
            'primary.is_remote_format_possible' => ['boolean'],
        ];
    }
}