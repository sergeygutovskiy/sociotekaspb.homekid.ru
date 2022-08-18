<?php

namespace App\Http\Validators\Client\Job;

use App\Enums\JobStatus;
use App\Http\Validators\Validator;
use Illuminate\Validation\Rule;

class ListValidator extends Validator
{
    public static function rules()
    {
        return [
            'page' => ['required', 'integer', 'min:1'],
            'limit' => ['required', 'integer', 'min:1'],

            'filter_name' => ['sometimes', 'string'],
            'filter_rating' => ['sometimes', 'integer', 'min:0', 'max:6'],
            'filter_status' => [
                'sometimes',
                'string',
                Rule::in([ JobStatus::ACCEPTED, JobStatus::PENDING, JobStatus::REJECTED ]),
            ],

            'filter_year' => ['sometimes', 'digits:4', 'integer', 'min:1900'],
            'filter_volunteer_id' => ['sometimes', 'integer'],

            'filter_is_any_review' => ['sometimes', 'boolean'],
            'filter_is_favorite' => ['sometimes', 'boolean'],
            'filter_is_approbation' => ['sometimes', 'boolean'],
            'filter_is_remote_format' => ['sometimes', 'boolean'],
            'filter_is_publication' => ['sometimes', 'boolean'],

            'filter_rnsu_category_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_needy_category_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_needy_category_target_group_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_social_service_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_company' => ['sometimes', 'string'],

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