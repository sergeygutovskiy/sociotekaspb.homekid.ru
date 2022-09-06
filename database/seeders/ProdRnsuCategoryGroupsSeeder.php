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
                'image_path' => '/storage/icons/rnsu-groups/grazhdane-pozhilogo-vozrasta.png',
                'rnsu_ids' => json_encode([ 291, 292, 293, 294, 295, 296, 297 ])
            ], [
                'label' => 'Инвалиды трудоспособного возраста',
                'image_path' => '/storage/icons/rnsu-groups/invalidy-trudosposobnogo-vozrasta.png',
                'rnsu_ids' => json_encode([ 298, 299, 300, 301, 302, 303, 304, 305, 306, 307 ])
            ], [
                'label' => 'Дети-инвалиды, дети раннего возраста',
                'image_path' => '/storage/icons/rnsu-groups/deti-invalidy.png',
                'rnsu_ids' => json_encode([ 308, 309, 310, 311, 312 ])
            ], [
                'label' => 'Несовершеннолетние',
                'image_path' => '/storage/icons/rnsu-groups/nesovershennoletnie-v-trudnoj-zhiznennoj-situacii.png',
                'rnsu_ids' => json_encode([ 313, 314 ])
            ], [
                'label' => 'Лица из числа детей-сирот и детей, оставшихся без попечения родителей, в возрасте от 18 до 23 лет, находящиеся в трудной жизненной ситуации',
                'image_path' => '/storage/icons/rnsu-groups/deti-siroty-deti-ot-18-23-let-nahodyashiesya-v-trudnoj-zhiznennoj-situacii.png',
                'rnsu_ids' => json_encode([ 315 ])
            ], [
                'label' => 'Семьи',
                'image_path' => '/storage/icons/rnsu-groups/semi.png',
                'rnsu_ids' => json_encode([ 316, 317 ])
            ], [
                'label' => 'Женщины',
                'image_path' => '/storage/icons/rnsu-groups/zhenshiny.png',
                'rnsu_ids' => json_encode([ 318, 319 ])
            ], [
                'label' => 'ВИЧ-инфицированные граждане и члены их семей',
                'image_path' => '/storage/icons/rnsu-groups/vich-inficirovannye-grazhdane-chleny-ih-semej.png',
                'rnsu_ids' => json_encode([ 320 ])
            ], [
                'label' => 'Граждане, зависимые от психоактивных веществ',
                'image_path' => '/storage/icons/rnsu-groups/grazhdane-zavisimye-ot-psihoaktivnyh-veshestv.png',
                'rnsu_ids' => json_encode([ 321 ])
            ], [
                'label' => 'Граждане без определенного места жительства',
                'image_path' => '/storage/icons/rnsu-groups/grazhdane-bez-opredelennogo-mesta-zhitelstva.png',
                'rnsu_ids' => json_encode([ 322 ])
            ], [
                'label' => 'Лица, отбывающие уголовное наказание или освобожденные',
                'image_path' => '/storage/icons/rnsu-groups/lica-otbyvayushie-ugolovnoe-nakazanie-ili-osvobozhdennye.png',
                'rnsu_ids' => json_encode([ 323 ])
            ], [
                'label' => 'Граждане трудоспособного возраста с заболеванием/травмой',
                'image_path' => '/storage/icons/rnsu-groups/grazhdane-trudosposobnogo-vozrasta-s-zabolevaniemtravmoj.png',
                'rnsu_ids' => json_encode([ 324 ])
            ],
        ]);
    }
}
