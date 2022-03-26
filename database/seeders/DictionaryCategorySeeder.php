<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DictionaryCategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('dictionary_categories')->insert([
            'id' => 1,
            'name' => 'Тип организации',
            'slug' => 'organization-type',
        ]);

        DB::table('dictionary_categories')->insert([
            'id' => 2,
            'name' => 'Район',
            'slug' => 'district',
        ]);
    }
}
