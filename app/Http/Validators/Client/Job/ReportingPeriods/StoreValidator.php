<?php

namespace App\Http\Validators\Client\Job\ReportingPeriods;

use App\Http\Validators\Validator;

class StoreValidator extends Validator
{
    public static function rules()
    {
        return [
            'reporting_periods' => ['array', 'present'],
            
            'reporting_periods.*.total' => ['integer', 'min:0'],
            'reporting_periods.*.year' => ['integer', 'min:0'],
            
            'reporting_periods.*.families' => ['integer', 'min:0', 'nullable'],
            'reporting_periods.*.children' => ['integer', 'min:0', 'nullable'],
            'reporting_periods.*.men' => ['integer', 'min:0', 'nullable'],
            'reporting_periods.*.women' => ['integer', 'min:0', 'nullable'],
        ];
    }
}