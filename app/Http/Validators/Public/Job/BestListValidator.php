<?php

namespace App\Http\Validators\Public\Job;

use App\Enums\JobVariant;
use App\Http\Validators\Validator;
use Illuminate\Validation\Rule;

class BestListValidator extends Validator
{
    public static function rules()
    {
        return [
            'page' => ['required', 'integer', 'min:1'],
            'limit' => ['required', 'integer', 'min:1'],

            'filter_variant' => Rule::in([
                JobVariant::SOCIAL_PROJECT,
                JobVariant::SOCIAL_WORK,
                JobVariant::CLUB,
                JobVariant::METHODOLOGY,
                JobVariant::EDU_PROGRAM,
            ]),

            'filter_rnsu_category_group_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_name' => ['sometimes', 'string'],
            'filter_district_id' => ['sometimes', 'integer'],
            'filter_organization_type_id' => ['sometimes', 'integer'],
            'filter_year' => ['sometimes', 'digits:4', 'integer', 'min:1900'],
            'filter_social_service_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_needy_category_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_needy_category_target_group_ids' => ['sometimes', 'regex:/^\d+(,\d+)*$/'],
            'filter_volunteer_id' => ['sometimes', 'integer'],
            'filter_is_remote_format' => ['sometimes', 'boolean'],
        ];
    }
}
