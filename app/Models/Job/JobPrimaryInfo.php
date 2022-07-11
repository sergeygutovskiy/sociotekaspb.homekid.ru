<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPrimaryInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'purpose',
        'objectives',
        'annotation',
        'main_qualitative_results',
        'brief_description_of_resources',
        'best_practice',
        'social_outcome',
        'implementation_for_citizen_id',
        'category_id',
        'form_of_social_service_id',
        'engagement_of_volunteers_id',
        'target_group_ids',
        'is_possibility_in_remote',
        'is_innovation_site',
        'is_has_expert_opinion',
        'is_has_expert_review',
        'is_has_expert_feedback',
        'photo_file_path',
        'video_link'
    ];

    protected $casts = [
        'target_group_ids' => 'array'
    ];
}
