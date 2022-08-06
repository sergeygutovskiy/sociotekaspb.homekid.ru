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
        'status',
        'is_favorite',
        'rejected_status_description',
    ];

    public function primary_information()
    {
        return $this->belongsTo(JobPrimaryInformation::class);
    }

    public function experience()
    {
        return $this->belongsTo(JobExperience::class);
    }

    public function contacts()
    {
        return $this->belongsTo(JobContacts::class);
    }

    public function reporting_periods()
    {
        return $this->hasMany(JobReportingPeriod::class);
    }

    public function social_project()
    {
        return $this->hasOne(SocialProject::class);
    }
}
