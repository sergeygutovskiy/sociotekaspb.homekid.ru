<?php

namespace App\Models;

use Database\Factories\RnsuCategoryGroupFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RnsuCategoryGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'image_path',
        'rnsu_ids',
    ];

    protected $casts = [
        'rnsu_ids' => 'array',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return RnsuCategoryGroupFactory::new();
    }
}
