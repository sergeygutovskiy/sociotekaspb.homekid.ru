<?php

namespace App\Models\Job\Implementation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'job_impl_projects';

    protected $fillable = [
        'job_id',
        'implementation_period',
        'technologies_forms_methods',
        'main_quantitative_results',
        'diagnostic_toolkit',
        'prevalence',
        'is_participant',
        'organizer',
        'status_id',
        'service_type_id',
        'work_name_id',
        'recognition_of_need_id',
        'rnsu_category_id',
        'partner_ids',
        'contacts_responsible_name',
        'contacts_email',
        'contacts_phone'
    ];

    protected $casts = [
        'partner_ids' => 'array'
    ];
}
