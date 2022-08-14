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
            
            'name_filter' => ['sometimes', 'string'],
            'rating_filter' => ['sometimes', 'integer', 'min:0', 'max:5'],
            'name_status' => [
                'sometimes',
                'string',
                Rule::in([ JobStatus::ACCEPTED, JobStatus::PENDING, JobStatus::REJECTED ]),
            ],
            'filter_is_any_review' => ['sometimes', 'boolean'],
            'filter_is_favorite' => ['sometimes', 'boolean'],
            'filter_is_approbation' => ['sometimes', 'boolean'],
            'filter_is_remote_format' => ['sometimes', 'boolean'],
            'filter_is_publication' => ['sometimes', 'boolean'],

            'filter_rnsu_category_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_needy_category_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_needy_category_target_group_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],

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