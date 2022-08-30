<?php

namespace App\Http\Validators\Public\Job;

use App\Enums\JobStatus;
use App\Http\Validators\Validator;
use Illuminate\Validation\Rule;

class ApprovedListValidator extends Validator
{
    public static function rules()
    {
        return [
            'page' => ['required', 'integer', 'min:1'],
            'limit' => ['required', 'integer', 'min:1'],

            'filter_name' => ['sometimes', 'string'],
            'filter_status' => [
                'sometimes',
                'string',
                Rule::in([ JobStatus::ACCEPTED, JobStatus::PENDING, JobStatus::REJECTED ]),
            ],

            'filter_year' => ['sometimes', 'digits:4', 'integer', 'min:1900'],
            'filter_volunteer_id' => ['sometimes', 'integer'],
            'filter_district_id' => ['sometimes', 'integer'],

            'filter_is_any_review' => ['sometimes', 'boolean'],
            'filter_is_favorite' => ['sometimes', 'boolean'],
            'filter_is_approbation' => ['sometimes', 'boolean'],
            'filter_is_remote_format' => ['sometimes', 'boolean'],
            'filter_is_publication' => ['sometimes', 'boolean'],

            'filter_rnsu_category_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_needy_category_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_needy_category_target_group_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_social_service_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_need_recognition_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_company' => ['sometimes', 'string'],
            'filter_is_practice_placed_in_asi_smarteka' => ['sometimes', 'boolean'],

            'sort_by' => [
                'sometimes',
                'string',
                Rule::in([ 'created_at', 'updated_at', 'status', 'rating' ]),
            ],
            'sort_direction' => [
                'required_with:sort_by',
                'string',
                Rule::in([ 'asc', 'desc' ]),
            ],
        ];
    }
}
