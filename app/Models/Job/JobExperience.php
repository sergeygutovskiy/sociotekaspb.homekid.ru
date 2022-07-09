<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'results_in_district_and_media',
        'results_on_television',
        'results_at_various_levels_events',
        'results_in_article',
        'results_on_website_of_institution',
        'conducting_master_classes',
        'results_on_radio'
    ];

    protected $casts = [
        'results_in_district_and_media' => 'array',
        'results_on_television' => 'array',
        'results_at_various_levels_events' => 'array',
        'results_in_article' => 'array',
        'results_on_website_of_institution' => 'array',
        'conducting_master_classes' => 'array',
        'results_on_radio' => 'array'
    ];
}
