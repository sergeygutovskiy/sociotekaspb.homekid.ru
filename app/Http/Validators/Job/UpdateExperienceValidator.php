<?php

namespace App\Http\Validators\Job;

use App\Http\Validators\Validator;

class UpdateExperienceValidator extends Validator
{
    public static function rules()
    {
        return [
            'experience.results_in_journal' => ['array', 'size:2', 'nullable', 'present'],
            'experience.results_in_journal.description' => ['sometimes', 'string', 'nullable'],
            'experience.results_in_journal.link' => ['sometimes', 'string', 'nullable'],
            
            'experience.results_of_various_events' => ['array', 'size:2', 'nullable', 'present'],
            'experience.results_of_various_events.description' => ['sometimes', 'string', 'nullable'],
            'experience.results_of_various_events.link' => ['sometimes', 'string', 'nullable'],
            
            'experience.results_info_in_site' => ['array', 'size:2', 'nullable', 'present'],
            'experience.results_info_in_site.description' => ['sometimes', 'string', 'nullable'],
            'experience.results_info_in_site.link' => ['sometimes', 'string', 'nullable'],
            
            'experience.results_info_in_media' => ['array', 'size:2', 'nullable', 'present'],
            'experience.results_info_in_media.description' => ['sometimes', 'string', 'nullable'],
            'experience.results_info_in_media.link' => ['sometimes', 'string', 'nullable'],
            
            'experience.results_seminars' => ['array', 'size:2', 'nullable', 'present'],
            'experience.results_seminars.description' => ['sometimes', 'string', 'nullable'],
            'experience.results_seminars.link' => ['sometimes', 'string', 'nullable'],
        ];
    }
}