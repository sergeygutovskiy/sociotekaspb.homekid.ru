<?php

namespace App\Models;

use App\Models\Job\Job;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'login',
        'password',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function company()
    {
        return $this->hasOne(Company::class, 'user_id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'user_id');
    }

    public function files()
    {
        return $this->hasMany(UserFile::class, 'user_id');
    }
}
