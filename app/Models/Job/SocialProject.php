<?php

namespace App\Models\Job;

use App\Models\Dictionary;
use Database\Factories\Job\SocialProjectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class SocialProject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'participant',
        'implementation_period',
        'implementation_level_id',
        'public_work_ids',
        'service_type_ids',
        'service_name_ids',
        'need_recognition_ids',
    ];

    protected $casts = [
        'participant' => 'array',
        'public_work_ids' => 'array',
        'service_type_ids' => 'array',
        'service_name_ids' => 'array',
        'need_recognition_ids' => 'array',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class)->withTrashed();
    }

    public function implementation_level()
    {
        return $this->belongsTo(Dictionary::class, 'implementation_level_id');
    }
    
    public function public_works()
    {
        return Dictionary::whereIn('id', $this->public_work_ids)->get();
    }

    public function service_types()
    {
        return Dictionary::whereIn('id', $this->service_type_ids)->get();
    }

    public function service_names()
    {
        return Dictionary::whereIn('id', $this->service_name_ids)->get();
    }

    public function need_recognitions()
    {
        return Dictionary::whereIn('id', $this->need_recognition_ids)->get();
    }

    protected static function newFactory()
    {
        return SocialProjectFactory::new();
    }

    public static function findOrFailByUserId(int $user_id, int $id): SocialProject
    {
        return SocialProject::whereHas('job', fn($q) => $q->where('user_id', $user_id))->findOrFail($id);
    } 

    public function scopeOptionalHasServiceTypes(Builder $query, ?array $ids)
    {
        if ( is_null($ids) ) return $query;
        return $query->whereJsonContains('service_type_ids', $ids);
    }

    public function scopeOptionalHasServiceNames(Builder $query, ?array $ids)
    {
        if ( is_null($ids) ) return $query;
        return $query->whereJsonContains('service_name_ids', $ids);
    }

    public function scopeOptionalHasPublicWorks(Builder $query, ?array $ids)
    {
        if ( is_null($ids) ) return $query;
        return $query->whereJsonContains('public_work_ids', $ids);
    }

    public function scopeOptionalHasNeedRecognitions(Builder $query, ?array $ids)
    {
        if ( is_null($ids) ) return $query;
        return $query->whereJsonContains('need_recognition_ids', $ids);
    }

    public function scopeOptionalHasImplementationLevel(Builder $query, ?int $implementation_level_id)
    {
        if ( is_null($implementation_level_id) ) return $query;
        return $query->where('implementation_level_id', $implementation_level_id);
    }

    public function scopeOptionalIsParticipant(Builder $query, ?bool $is_participant)
    {
        if ( is_null($is_participant) ) return $query;
        return $is_participant
            ? $query->whereNot('participant', null)
            : $query->where('participant', null)
        ;
    }
}
