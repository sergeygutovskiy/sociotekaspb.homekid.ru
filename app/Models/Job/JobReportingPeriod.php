<?php

namespace App\Models\Job;

use Database\Factories\Job\ReportingPeriodFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobReportingPeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'year',
        'families',
        'children',
        'men',
        'women',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ReportingPeriodFactory::new();
    }
}
