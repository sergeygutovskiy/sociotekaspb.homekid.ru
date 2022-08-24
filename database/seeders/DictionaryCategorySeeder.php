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
            [ 'name' => 'Реализация для гражданина бесплатно/платно', 'slug' => 'payment-method' ],
            [ 'name' => 'Привлечение добровольцев и волонтеров', 'slug' => 'volunteer' ],
            [ 'name' => 'Категория', 'slug' => 'needy-category' ],
            [ 'name' => 'Целевая группа (Категория)', 'slug' => 'needy-category-target-group' ],
            [ 'name' => 'Форма социального обслуживания', 'slug' => 'social-service' ],

            [ 'name' => 'Уровень реализации проекта', 'slug' => 'implementation-level' ],
            [ 'name' => 'Категории по РНСУ', 'slug' => 'rnsu-category' ],
            [ 'name' => 'Наименование государственной работы', 'slug' => 'public-work' ],
            [ 'name' => 'Вид услуги', 'slug' => 'service-type' ],
            [ 'name' => 'Наименование услуги', 'slug' => 'service-name' ],
            [ 'name' => 'Обстоятельства признания нуждаемости', 'slug' => 'need-recognition' ],
            [ 'name' => 'Направленность', 'slug' => 'direction' ],
            [ 'name' => 'Форма проведения занятий', 'slug' => 'conducting-classes-form' ],
            [ 'name' => 'Вид программы', 'slug' => 'program-type' ],
            [ 'name' => 'Распространенность методики', 'slug' => 'prevalence' ],
            [ 'name' => 'Форма организации деятельности при реализации технологии/методики', 'slug' => 'activity-organization-form' ],
            [ 'name' => 'Период применения (продолжительность реализации)', 'slug' => 'application-period' ],
        ]);
    }
}
