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
            [ 'login' => 'user1',  'password' => Hash::make('1234'), 'is_admin' => false ],
            [ 'login' => 'user2',  'password' => Hash::make('1234'), 'is_admin' => false ],
            [ 'login' => 'user3',  'password' => Hash::make('1234'), 'is_admin' => false ],
            [ 'login' => 'user4',  'password' => Hash::make('1234'), 'is_admin' => false ],
            [ 'login' => 'user5',  'password' => Hash::make('1234'), 'is_admin' => false ],
            [ 'login' => 'user6',  'password' => Hash::make('1234'), 'is_admin' => false ],
            [ 'login' => 'user7',  'password' => Hash::make('1234'), 'is_admin' => false ],
            [ 'login' => 'user8',  'password' => Hash::make('1234'), 'is_admin' => false ],
            [ 'login' => 'user9',  'password' => Hash::make('1234'), 'is_admin' => false ],
            [ 'login' => 'user10', 'password' => Hash::make('1234'), 'is_admin' => false ],
            [ 'login' => 'admin',  'password' => Hash::make('1234'), 'is_admin' => true  ],
        ]);
    }
}
