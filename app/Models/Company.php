<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'full_name',
        'owner',
        'responsible',
        'organization_type_id',
        'district_id',
        'is_has_education_license',
        'is_has_mdedical_license',
        'is_has_innovative_platform',
        'status',
    ];

    protected $casts = [
        'is_has_education_license' => 'boolean',
        'is_has_mdedical_license' => 'boolean',
        'is_has_innovative_platform' => 'boolean',
    ];
}
