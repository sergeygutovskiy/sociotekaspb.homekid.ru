<?php

namespace App\Models;

use Database\Factories\CompanyFactory;
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
        'rejected_status_description',
    ];

    protected $casts = [
        'education_license' => 'array',
        'medical_license' => 'array',
        'is_has_innovative_platform' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function district()
    {
        return $this->belongsTo(Dictionary::class, 'district_id');
    }

    public function organization_type()
    {
        return $this->belongsTo(Dictionary::class, 'organization_type_id');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return CompanyFactory::new();
    }
}
