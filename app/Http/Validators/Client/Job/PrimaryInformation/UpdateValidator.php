<?php

namespace App\Http\Validators\Client\Job\PrimaryInformation;

use App\Http\Validators\Validator;

class UpdateValidator extends Validator
{
    public static function rules()
    {
        return [
            'primary.name' => ['required', 'string'],
            'primary.annotation' => ['required', 'string'],
            'primary.objectives' => ['required', 'string'],
            'primary.purpose' => ['required', 'string'],
            
            'primary.partnership' => ['array', 'size:1', 'nullable', 'present'],
            'primary.partnership.description' => ['required_with:primary.partnership', 'string'],

            'primary.volunteer_id' => ['required', 'integer', 'exists:dictionaries,id'],

            'primary.needy_category_ids' => ['array', 'present'],
            'primary.needy_category_ids.*' => ['required', 'integer', 'exists:dictionaries,id'],
            'primary.needy_category_target_group_ids' => ['array', 'present'],
            'primary.needy_category_target_group_ids.*' => ['required', 'integer', 'exists:dictionaries,id'],

            'primary.social_service_ids' => ['array', 'present'],
            'primary.social_service_ids.*' => ['required', 'integer', 'exists:dictionaries,id'],

            'primary.rnsu_category_ids' => ['array', 'present'],
            'primary.rnsu_category_ids.*' => ['required', 'integer', 'exists:dictionaries,id'],

            'primary.need_recognition_ids' => ['array', 'present'],
            'primary.need_recognition_ids.*' => ['required', 'integer', 'exists:dictionaries,id'],

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

            'primary.is_best_practice' => ['required', 'boolean'],
            'primary.is_remote_format_possible' => ['required', 'boolean'],
            'primary.is_practice_placed_in_asi_smarteka' => ['required', 'boolean'],
        ];
    }
}
