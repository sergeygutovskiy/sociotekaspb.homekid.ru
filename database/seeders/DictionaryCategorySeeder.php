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

        // 

        DB::table('dictionary_categories')->insert([
            'id' => 3,
            'name' => 'Реализация для гражданина',
            'slug' => 'implementation-for-citizen',
        ]);

        DB::table('dictionary_categories')->insert([
            'id' => 4,
            'name' => 'Категория',
            'slug' => 'category',
        ]);

        DB::table('dictionary_categories')->insert([
            'id' => 5,
            'name' => 'Форма социального обслуживания',
            'slug' => 'form-of-social-service',
        ]);

        DB::table('dictionary_categories')->insert([
            'id' => 6,
            'name' => 'Привлечение добровольцев и волонтеров',
            'slug' => 'engagement-of-volunteers',
        ]);

        DB::table('dictionary_categories')->insert([
            'id' => 7,
            'name' => 'Целевая группа',
            'slug' => 'target-group',
        ]);

        // 

        DB::table('dictionary_categories')->insert([
            'id' => 8,
            'name' => 'Статус',
            'slug' => 'job-status',
        ]);

        DB::table('dictionary_categories')->insert([
            'id' => 9,
            'name' => 'Вид услуги',
            'slug' => 'service-type',
        ]);

        DB::table('dictionary_categories')->insert([
            'id' => 10,
            'name' => 'Наименование работ',
            'slug' => 'work-name',
        ]);

        DB::table('dictionary_categories')->insert([
            'id' => 11,
            'name' => 'Обстоятельства признания нуждаемости',
            'slug' => 'circumstances-of-recognition-of-need',
        ]);

        DB::table('dictionary_categories')->insert([
            'id' => 12,
            'name' => 'Категория по РНСУ',
            'slug' => 'rnsu-category',
        ]);
    }
}
