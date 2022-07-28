<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    use HasFactory;

    public function dictionaries(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Dictionary::class, 'parent_id');
    }
}
