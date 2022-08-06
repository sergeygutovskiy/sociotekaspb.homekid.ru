<?php

namespace App\Http\Validators\Client\Job\ReportingPeriods;

use App\Http\Validators\Validator;

class UpdateValidator extends Validator
{
    public static function rules()
    {
        return [
            'reporting_periods' => ['array', 'present'],
            
            'reporting_periods.*.id' => ['sometimes', 'integer', 'exists:job_reporting_periods,id'],
            'reporting_periods.*.total' => ['integer', 'min:0'],
            'reporting_periods.*.year' => ['integer', 'min:0'],
            
            'reporting_periods.*.families' => ['integer', 'min:0', 'nullable'],
            'reporting_periods.*.children' => ['integer', 'min:0', 'nullable'],
            'reporting_periods.*.men' => ['integer', 'min:0', 'nullable'],
            'reporting_periods.*.women' => ['integer', 'min:0', 'nullable'],
        ];
    }
}