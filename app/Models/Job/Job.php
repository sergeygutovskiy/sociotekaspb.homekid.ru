<?php

namespace App\Models\Job;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Builder;
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
        'rating',
        'rejected_status_description',
        'updated_at',
    ];

    protected $casts = [
        'is_favorite' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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

    public function getRatingExpandedAttribute()
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

    public function scopeOptionalHasNameLike(Builder $query, string | null $name)
    {
        if ( is_null($name) || !strlen($name) ) return $query;
        return $query->whereHas('primary_information', fn($q) => $q->where('name', 'like', '%'.$name.'%'));
    }

    public function scopeOptionalHasStatus(Builder $query, string | null $status)
    {
        if ( is_null($status) || !strlen($status) ) return $query;
        return $query->where('status', $status);
    }

    public function scopeOptionalHasRating(Builder $query, int | null $rating)
    {
        if ( is_null($rating) ) return $query;
        return $query->where('rating', $rating);
    }

    public function scopeOptionalOrderBy(Builder $query, string | null $order_by, string | null $dir)
    {
        if ( is_null($order_by) || !strlen($order_by) ) return $query;
        if ( is_null($dir) || !strlen($dir) ) return $query;

        $order_col = 'id';
        switch ($order_by)
        {
            case 'created_at': $order_col = 'created_at'; break;
            case 'updated_at': $order_col = 'updated_at'; break;
            case 'status': $order_col = 'status'; break;
            case 'rating': $order_col = 'rating'; break;            
        }

        return $query->orderBy($order_col, $dir);
    }
}
