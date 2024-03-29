<?php

namespace App\Models\Job;

use App\Enums\CompanyStatus;
use App\Enums\JobStatus;
use App\Models\Job\Variant\Club;
use App\Models\Job\Variant\EduProgram;
use App\Models\Job\Variant\Methodology;
use App\Models\Job\Variant\SocialProject;
use App\Models\Job\Variant\SocialWork;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'primary_information_id',
        'experience_id',
        'contacts_id',
        'status',
        'is_favorite',
        'rating',
        'rejected_status_description',
        'updated_at',
        'variant',
        'variant_id',
    ];

    protected $casts = [
        'is_favorite' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->user->company();
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
        return $this->hasMany(JobReportingPeriod::class)->orderBy('year', 'desc');
    }

    public function social_project()
    {
        return $this->hasOne(SocialProject::class);
    }

    public function edu_program()
    {
        return $this->hasOne(EduProgram::class);
    }

    public function social_work()
    {
        return $this->hasOne(SocialWork::class);
    }

    public function club()
    {
        return $this->hasOne(Club::class);
    }

    public function methodology()
    {
        return $this->hasOne(Methodology::class);
    }

    public function getYearAttribute()
    {
        $years = $this->reporting_periods->pluck('year');
        $min_year = $years->min();
        $max_year = $years->max();

        $year = new stdClass();
        $year->min = $min_year;
        $year->max = $max_year;

        return $year;
    }

    public function getRatingExpandedAttribute()
    {
        $is_favorite = $this->is_favorite;
        $is_practice_placed_in_asi_smarteka = $this->primary_information->is_practice_placed_in_asi_smarteka;
        $is_has_publication = !!$this->experience->results_in_journal;
        $is_has_approbation = !!$this->primary_information->approbation;
        $is_has_replicability = !!$this->primary_information->replicability;
        $is_has_any_review = (
            !!$this->primary_information->expert_opinion ||
            !!$this->primary_information->review ||
            !!$this->primary_information->comment
        );

        $rating_count = $is_favorite 
            + $is_practice_placed_in_asi_smarteka
            + $is_has_approbation 
            + $is_has_replicability 
            + $is_has_publication
            + $is_has_any_review;

        $rating = new stdClass();
        $rating->count = $rating_count;
        
        $rating_fields = new stdClass();
        $rating_fields->is_favorite = $is_favorite;
        $rating_fields->is_practice_placed_in_asi_smarteka = $is_practice_placed_in_asi_smarteka;
        $rating_fields->is_has_publication = $is_has_publication;
        $rating_fields->is_has_approbation = $is_has_approbation;
        $rating_fields->is_has_replicability = $is_has_replicability;
        $rating_fields->is_has_any_review = $is_has_any_review;
    
        $rating->fields = $rating_fields;

        return $rating;
    }

    public function scopeOptionalHasNameLike(Builder $query, ?string $name)
    {
        if ( is_null($name) || !strlen($name) ) return $query;
        return $query->whereHas('primary_information', fn($q) => $q->where('name', 'like', '%'.$name.'%'));
    }

    public function scopeOptionalHasStatus(Builder $query, ?string $status)
    {
        if ( is_null($status) || !strlen($status) ) return $query;
        return $query->where('status', $status);
    }

    public function scopeOptionalHasRating(Builder $query, ?int $rating)
    {
        if ( is_null($rating) ) return $query;
        return $query->where('rating', $rating);
    }

    public function scopeOptionalIsFavorite(Builder $query, ?bool $is_favorite)
    {
        if ( is_null($is_favorite) ) return $query;
        return $query->where('is_favorite', $is_favorite);
    }

    public function scopeOptionalHasApprobation(Builder $query, ?bool $is_approbation)
    {
        if ( is_null($is_approbation) ) return $query;
        return $query->whereHas(
            'primary_information', 
            fn(Builder $q) => $is_approbation
                ? $q->whereNot('approbation', null)
                : $q->where('approbation', null)
        );
    }

    public function scopeOptionalIsRemoteFormat(Builder $query, ?bool $is_remote_format)
    {
        if ( is_null($is_remote_format) ) return $query;
        return $query->whereHas(
            'primary_information', 
            fn(Builder $q) => $q->where('is_remote_format_possible', $is_remote_format)
        );
    }

    public function scopeOptionalHasAnyReview(Builder $query, ?bool $is_any_review)
    {
        if ( is_null($is_any_review) ) return $query;
        return $query->whereHas(
            'primary_information', 
            fn(Builder $q) => $q->where(fn($subq) => $is_any_review
                ? $subq
                    ->whereNot('expert_opinion', null)
                    ->orWhereNot('review', null)
                    ->orWhereNot('comment', null)
                : $subq
                    ->where('expert_opinion', null)
                    ->where('review', null)
                    ->where('comment', null)
            )
        );
    }

    public function scopeOptionalHasPublication(Builder $query, ?bool $is_publication)
    {
        if ( is_null($is_publication) ) return $query;
        return $query->whereHas(
            'experience', 
            fn(Builder $q) => $is_publication
                ? $q->whereNot('results_in_journal', null)
                : $q->where('results_in_journal', null)
        );
    }

    public function scopeOptionalIsPracticePlacedInAsiSmarteka(Builder $query, ?bool $is_practice_placed_in_asi_smarteka)
    {
        if ( is_null($is_practice_placed_in_asi_smarteka) ) return $query;
        return $query->whereHas(
            'primary_information',
            fn(Builder $q) => $q->where('is_practice_placed_in_asi_smarteka', $is_practice_placed_in_asi_smarteka)
        );
    }

    public function scopeOptionalHasVolunteer(Builder $query, ?int $volunteer_id)
    {
        if ( is_null($volunteer_id) ) return $query;
        return $query->whereHas(
            'primary_information', 
            fn(Builder $q) => $q->where('volunteer_id', $volunteer_id)
        );
    }

    public function scopeOptionalHasRnsuCategories(Builder $query, ?array $ids)
    {
        if ( is_null($ids) ) return $query;
        return $query->whereHas(
            'primary_information', 
            fn(Builder $q) => $q->whereJsonContains('rnsu_category_ids', $ids)
        );
    }

    public function scopeOptionalHasNeedyCategories(Builder $query, ?array $ids)
    {
        if ( is_null($ids) ) return $query;
        return $query->whereHas(
            'primary_information', 
            fn(Builder $q) => $q->whereJsonContains('needy_category_ids', $ids)
        );
    }

    public function scopeOptionalHasNeedyCategoryTargetGroups(Builder $query, ?array $ids)
    {
        if ( is_null($ids) ) return $query;
        return $query->whereHas(
            'primary_information', 
            fn(Builder $q) => $q->whereJsonContains('needy_category_target_group_ids', $ids)
        );
    }

    public function scopeOptionalHasSocialServices(Builder $query, ?array $ids)
    {
        if ( is_null($ids) ) return $query;
        return $query->whereHas(
            'primary_information', 
            fn(Builder $q) => $q->whereJsonContains('social_service_ids', $ids)
        );
    }
    
    public function scopeOptionalHasReportingPeriodOfYear(Builder $query, ?int $year)
    {
        if ( is_null($year) ) return $query;
        return $query->whereHas(
            'reporting_periods',
            fn(Builder $q) => $q->where('year', $year)
        );
    }

    public function scopeOptionalHasCompany(Builder $query, ?string $company)
    {
        if ( is_null($company) ) return $query;
        return $query->whereHas(
            'user',
            fn(Builder $q) => $q->whereHas('company', fn($qq) => $qq->where('name', 'like', '%'.$company.'%'))
        );
    }

    public function scopeOptionalHasNeedRecognitions(Builder $query, ?array $ids)
    {
        if ( is_null($ids) ) return $query;
        return $query->whereHas(
            'primary_information', 
            fn(Builder $q) => $q->whereJsonContains('need_recognition_ids', $ids)
        );
    }

    public function scopeApproved(Builder $query)
    {
        return $query->where('status', JobStatus::ACCEPTED);
    }

    public function scopeWithApprovedCompany(Builder $query)
    {
        return $query->whereHas(
            'user',
            fn(Builder $q) => $q->whereHas('company', fn($qq) => $qq->where('status', CompanyStatus::ACCEPTED))
        );
    }

    public function scopeOptionalWithCompanyWithDistrict(Builder $query, ?int $district_id)
    {
        if ( is_null($district_id) ) return $query;

        return $query->whereHas(
            'user',
            fn(Builder $q) => $q->whereHas(
                'company', 
                fn($qq) => $qq->where('district_id', $district_id))
        );
    }

    public function scopeOptionalWithCompanyWithOrganisationType(Builder $query, ?int $organization_type_id)
    {
        if ( is_null($organization_type_id) ) return $query;

        return $query->whereHas(
            'user',
            fn(Builder $q) => $q->whereHas(
                'company', 
                fn($qq) => $qq->where('organization_type_id', $organization_type_id))
        );
    }

    public function scopeOptionalHasVariant(Builder $query, ?string $variant)
    {
        if ( is_null($variant) ) return $query;
        return $query->whereHas($variant);
    }

    public function scopeOptionalOrderBy(Builder $query, ?string $order_by, ?string $dir)
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
