<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPrimaryInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'annotation',
        'objectives',
        'purpose',
        'payment_method_id',
        'partnership',
        'volunteer_id',
        'needy_category_ids',
        'needy_category_target_group_ids',
        'social_service_ids',
        'qualitative_results',
        'social_results',
        'replicability',
        'approbation',
        'expert_opinion',
        'review',
        'comment',
        'video',
        'required_resources_description',
        'photo',
        'gallery',
        'is_best_practice',
        'is_remote_format_possible',
    ];

    protected $casts = [
        'partnership' => 'array',
        'needy_category_ids' => 'array',
        'needy_category_target_group_ids' => 'array',
        'social_service_ids' => 'array',
        'approbation' => 'array',
        'expert_opinion' => 'array',
        'review' => 'array',
        'comment' => 'array',
        'gallery' => 'array',
        'is_best_practice' => 'boolean',
        'is_remote_format_possible' => 'boolean',
    ];
}
