<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Public\DictionaryResource;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Models\Job\JobReportingPeriod;
use stdClass;

class DicionaryController extends Controller
{
    public function job_reporting_period_years()
    {
        $min_year = JobReportingPeriod::min('year');
        $max_year = JobReportingPeriod::max('year');

        $years = collect([]);
        for ( $i = $min_year; $i <= $max_year; $i++ ) $years->add($i);

        $years_resource = $years->reverse()->map(function($year) {
            $dictionary = new stdClass();
            $dictionary->id = $year;
            $dictionary->label = $year;

            return $dictionary;
        });

        return ResourceOKResponse::response(DictionaryResource::collection($years_resource));
    }
}
