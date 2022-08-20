<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class DictionarySeeder extends Seeder
{
    const DICTIONARIES_PER_CATEGORY_COUNT = 10;

    public function run(): void
    {
        $dictionary_categories = DictionaryCategory::all();

        foreach ($dictionary_categories as $category) 
        {
            for ($i = 0; $i < self::DICTIONARIES_PER_CATEGORY_COUNT; $i++) 
            {
                Dictionary::create([
                    'category_id' => $category->id,
                    'label' => strtolower($category->name . ' №' . ($i + 1))
                ]);
            }
        }

        $needy_category = DictionaryCategory::firstWhere('slug', 'needy-category');
        $needy_target_group_category = DictionaryCategory::firstWhere('slug', 'needy-category-target-group');

        $needy_category_dictionaries = $needy_category->dictionaries();
        $needy_target_group_category_dictionaries = $needy_target_group_category->dictionaries();

        $needy_target_group_category_dictionaries->take(10)->update([
            'parent_id' => $needy_category_dictionaries->first()->id
        ]);

        $needy_target_group_category_dictionaries->take(8)->update([
            'parent_id' => $needy_category_dictionaries->offset(1)->first()->id
        ]);

        $needy_target_group_category_dictionaries->take(6)->update([
            'parent_id' => $needy_category_dictionaries->offset(2)->first()->id
        ]);

        $needy_target_group_category_dictionaries->take(4)->update([
            'parent_id' => $needy_category_dictionaries->offset(3)->first()->id
        ]);

        $needy_target_group_category_dictionaries->take(2)->update([
            'parent_id' => $needy_category_dictionaries->offset(4)->first()->id
        ]);

        // 

        $service_type_category = DictionaryCategory::firstWhere('slug', 'service-type');
        $service_name_category = DictionaryCategory::firstWhere('slug', 'service-name');

        $service_type_dictionaries = $service_type_category->dictionaries();
        $service_name_dictionaries = $service_name_category->dictionaries();

        $service_name_dictionaries->take(10)->update([
            'parent_id' => $service_type_dictionaries->first()->id
        ]);

        $service_name_dictionaries->take(8)->update([
            'parent_id' => $service_type_dictionaries->offset(1)->first()->id
        ]);

        $service_name_dictionaries->take(6)->update([
            'parent_id' => $service_type_dictionaries->offset(2)->first()->id
        ]);

        $service_name_dictionaries->take(4)->update([
            'parent_id' => $service_type_dictionaries->offset(3)->first()->id
        ]);

        $service_name_dictionaries->take(2)->update([
            'parent_id' => $service_type_dictionaries->offset(4)->first()->id
        ]);
    }
}
