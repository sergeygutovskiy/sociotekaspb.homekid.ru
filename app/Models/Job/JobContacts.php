<?php

namespace App\Models\Job;

use Database\Factories\Job\ContactsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobContacts extends Model
{
    use HasFactory;

    protected $fillable = [
        'fio',
        'email',
        'phone',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ContactsFactory::new();
    }
}
