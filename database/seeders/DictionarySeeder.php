<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class DictionarySeeder extends Seeder
{
    public function run()
    {
        $dictionary_categories = DictionaryCategory::all();

        // create dictionary item for each category
        foreach ($dictionary_categories as $category) {
            // 5 times
            for ($i = 0; $i < 5; $i++) {
                Dictionary::create([
                    'category_id' => $category->id,
                    'label' => strtolower($category->name . ' №' . $i+1) 
                ]);
            }
        }
    }
}
