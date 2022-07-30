<?php

namespace App\Models\Job;

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
}
