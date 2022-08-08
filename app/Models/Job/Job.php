<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use stdClass;

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
        'updated_at',
    ];

    protected $casts = [
        'is_favorite' => 'boolean',
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

    public function getRatingAttribute()
    {
        $is_favorite = $this->is_favorite;
        $is_has_publication = !!$this->experience->results_in_journal;
        $is_has_approbation = !!$this->primary_information->approbation;
        $is_has_replicability = !!$this->primary_information->replicability;
        $is_has_any_review = (
            !!$this->primary_information->expert_opinion ||
            !!$this->primary_information->review ||
            !!$this->primary_information->comment
        );

        $rating_count = $is_favorite 
            + $is_has_approbation 
            + $is_has_replicability 
            + $is_has_publication
            + $is_has_any_review;

        $rating = new stdClass();
        $rating->count = $rating_count;
        
        $rating_fields = new stdClass();
        $rating_fields->is_favorite = $is_favorite;
        $rating_fields->is_has_publication = $is_has_publication;
        $rating_fields->is_has_approbation = $is_has_approbation;
        $rating_fields->is_has_replicability = $is_has_replicability;
        $rating_fields->is_has_any_review = $is_has_any_review;
    
        $rating->fields = $rating_fields;

        return $rating;
    }
}
