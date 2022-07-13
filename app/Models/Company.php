<?php

namespace App\Models;

use App\Models\Job\Job;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'full_name',
        
        'phone',
        'site',
        'email',
        
        'owner',
        'responsible',
        'responsible_phone',
        
        'organization_type_id',
        'district_id',
        
        'education_license',
        'medical_license',
        'is_has_innovative_platform',
        
        'status',
    ];

    protected $casts = [
        'education_license' => 'array',
        'medical_license' => 'array',
        'is_has_innovative_platform' => 'boolean',
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
