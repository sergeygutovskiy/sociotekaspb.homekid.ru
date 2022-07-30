<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'primary_information_id',
        'experience_id',
        'contacts_id',
    ];

    public function reporting_periods()
    {
        return $this->hasMany(JobReportingPeriod::class);
    }

    public function social_projects()
    {
        return $this->hasMany(SocialProject::class);
    }
}
