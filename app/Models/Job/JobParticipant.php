<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_number_of_participants',
        'number_of_families',
        'number_of_children',
        'number_of_men',
        'number_of_women',
        'reporting_period_year'
    ];
}
