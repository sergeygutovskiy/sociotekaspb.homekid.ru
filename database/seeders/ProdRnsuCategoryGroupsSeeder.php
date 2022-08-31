<?php

namespace Database\Seeders;

use App\Models\RnsuCategoryGroup;
use Illuminate\Database\Seeder;

class ProdRnsuCategoryGroupsSeeder extends Seeder
{
    public function run(): void
    {
        RnsuCategoryGroup::insert([
            [ 
                'label' => 'Граждане пожилого возраста',
                'image_path' => 'https://picsum.photos/40/40',
                'rnsu_ids' => [ 291, 292, 293, 294, 295, 296, 297 ] ],
            [ 
                'label' => 'Инвалиды трудоспособного возраста',
                'image_path' => 'https://picsum.photos/40/40',
                'rnsu_ids' => [ 298, 299, 300, 301, 302, 303, 304, 305, 306, 307 ] ],
            [ 
                'label' => 'Дети-инвалиды, дети раннего возраста',
                'image_path' => 'https://picsum.photos/40/40',
                'rnsu_ids' => [ 308, 309, 310, 311, 312 ] ],
            [ 
                'label' => 'Несовершеннолетние',
                'image_path' => 'https://picsum.photos/40/40',
                'rnsu_ids' => [ 313, 314 ] ],
            [ 
                'label' => 'Лица из числа детей-сирот и детей, оставшихся без попечения родителей, в возрасте от 18 до 23 лет, находящиеся в трудной жизненной ситуации',
                'image_path' => 'https://picsum.photos/40/40',
                'rnsu_ids' => [ 315 ] ],
            [ 
                'label' => 'Семьи',
                'image_path' => 'https://picsum.photos/40/40',
                'rnsu_ids' => [ 316, 317 ] ],
            [ 
                'label' => 'Женщины',
                'image_path' => 'https://picsum.photos/40/40',
                'rnsu_ids' => [ 318, 319 ] ],
            [ 
                'label' => 'ВИЧ-инфицированные граждане и члены их семей',
                'image_path' => 'https://picsum.photos/40/40',
                'rnsu_ids' => [ 320 ] ],
            [ 
                'label' => 'Граждане, зависимые от психоактивных веществ',
                'image_path' => 'https://picsum.photos/40/40',
                'rnsu_ids' => [ 321 ] ],
            [ 
                'label' => 'Граждане без определенного места жительства',
                'image_path' => 'https://picsum.photos/40/40',
                'rnsu_ids' => [ 322 ] ],
            [ 
                'label' => 'Лица, отбывающие уголовное наказание или освобожденные',
                'image_path' => 'https://picsum.photos/40/40',
                'rnsu_ids' => [ 323 ] ],
            [ 
                'label' => 'Граждане трудоспособного возраста с заболеванием/травмой',
                'image_path' => 'https://picsum.photos/40/40',
                'rnsu_ids' => [ 324 ] ],
        ]);
    }
}
