<?php

namespace Database\Seeders;

use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class DictionaryCategorySeeder extends Seeder
{
    public function run()
    {
        DictionaryCategory::insert([
            [ 'name' => 'Тип организации', 'slug' => 'organization-type' ],
            [ 'name' => 'Район', 'slug' => 'district' ],
        ]);
    }
}
