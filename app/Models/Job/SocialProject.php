<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant',
        'implementation_period',
        'implementation_level_id',
        'rnsu_category_ids',
        'public_work_ids',
        'service_type_ids',
        'service_name_ids',
        'need_recognition_ids',
    ];

    protected $casts = [
        'participant' => 'array',
        'implementation_period' => 'array',
        'rnsu_category_ids' => 'array',
        'public_work_ids' => 'array',
        'service_type_ids' => 'array',
        'service_name_ids' => 'array',
        'need_recognition_ids' => 'array',
    ];
}
