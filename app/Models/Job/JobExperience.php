<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'results_in_journal',
        'results_of_various_events',
        'results_info_in_site',
        'results_info_in_media',
        'results_seminars',
    ];

    protected $casts = [
        'results_in_journal' => 'array',
        'results_of_various_events' => 'array',
        'results_info_in_site' => 'array',
        'results_info_in_media' => 'array',
        'results_seminars' => 'array',
    ];
}
