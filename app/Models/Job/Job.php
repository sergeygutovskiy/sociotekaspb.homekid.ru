<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'primary_info_id',
        'experience_id'
    ];

    public function primary_info()
    {
        return $this->belongsTo(JobPrimaryInfo::class);
    }

    public function experience()
    {
        return $this->belongsTo(JobExperience::class);
    }

    public function participants()
    {
        return $this->hasMany(JobParticipant::class);
    }
}
