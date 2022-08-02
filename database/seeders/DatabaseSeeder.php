<?php

namespace Database\Seeders;

use Database\Seeders\Job\JobSeeder;
use Database\Seeders\Job\SocialProjectSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            DictionaryCategorySeeder::class,
            DictionarySeeder::class,
            CompanySeeder::class,
            
            JobSeeder::class,
            SocialProjectSeeder::class,
        ]);
    }
}
