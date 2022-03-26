<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'login' => 'user1',
            'password' => Hash::make('1234'),
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'login' => 'user2',
            'password' => Hash::make('1234'),
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'login' => 'user3',
            'password' => Hash::make('1234'),
        ]);
    }
}
