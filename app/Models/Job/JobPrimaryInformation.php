<?php

namespace App\Models\Job;

use App\Models\Dictionary;
use Database\Factories\Job\PrimaryInformationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPrimaryInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'annotation',
        'objectives',
        'purpose',
        'partnership',
        'volunteer_id',
        'needy_category_ids',
        'needy_category_target_group_ids',
        'social_service_ids',
        'rnsu_category_ids',
        'need_recognition_ids',
        'qualitative_results',
        'social_results',
        'replicability',
        'approbation',
        'expert_opinion',
        'review',
        'comment',
        'video',
        'required_resources_description',
        'photo_file_id',
        'gallery_file_ids',
        'is_best_practice',
        'is_remote_format_possible',
        'is_practice_placed_in_asi_smarteka',
    ];

    protected $casts = [
        'partnership' => 'array',
        'needy_category_ids' => 'array',
        'needy_category_target_group_ids' => 'array',
        'social_service_ids' => 'array',
        'rnsu_category_ids' => 'array',
        'need_recognition_ids' => 'array',
        'approbation' => 'array',
        'expert_opinion' => 'array',
        'review' => 'array',
        'comment' => 'array',
        'gallery_file_ids' => 'array',
        'is_best_practice' => 'boolean',
        'is_remote_format_possible' => 'boolean',
        'is_practice_placed_in_asi_smarteka' => 'boolean',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return PrimaryInformationFactory::new();
    }

    public function needy_categories()
    {
        return Dictionary::whereIn('id', $this->needy_category_ids)->get();
    }

    public function needy_category_target_groups()
    {
        return Dictionary::whereIn('id', $this->needy_category_target_group_ids)->get();
    }

    public function social_services()
    {
        return Dictionary::whereIn('id', $this->social_service_ids)->get();
    }

    public function rnsu_categories()
    {
        return Dictionary::whereIn('id', $this->rnsu_category_ids)->get();
    }

    public function need_recognitions()
    {
        return Dictionary::whereIn('id', $this->need_recognition_ids)->get();
    }

    public function volunteer()
    {
        return $this->belongsTo(Dictionary::class, 'volunteer_id');
    }
}
