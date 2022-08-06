<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            [ 'login' => 'user1', 'password' => Hash::make('1234'), 'is_admin' => false ],
            [ 'login' => 'user2', 'password' => Hash::make('1234'), 'is_admin' => false ],
            [ 'login' => 'user3', 'password' => Hash::make('1234'), 'is_admin' => false ],
            [ 'login' => 'admin', 'password' => Hash::make('1234'), 'is_admin' => true ],
        ]);
    }
}
