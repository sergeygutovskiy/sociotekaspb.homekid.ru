<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\DictionaryResource;
use App\Models\Job\JobReportingPeriod;
use stdClass;

class DicionaryController extends Controller
{
    public function job_reporting_period_years()
    {
        $years = JobReportingPeriod::select('year')->orderBy('year', 'desc')->distinct()->pluck('year');
        $years_resource = $years->map(function($year) {
            $dictionary = new stdClass();
            $dictionary->id = $year;
            $dictionary->label = $year;

            return $dictionary;
        });
        return DictionaryResource::collection($years_resource);
    }
}
