<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictionaryCategory extends Model
{
    use HasFactory;

    public function dictionaries()
    {
        return $this->hasMany(Dictionary::class, 'category_id');
    }
}
