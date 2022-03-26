<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DictionarySeeder extends Seeder
{
    public function run()
    {
        for ( $i = 1; $i <= 5; $i++ )
        {
            DB::table('dictionaries')->insert([
                'category_id' => 1,
                'label' => 'Тип огранизации №' . $i,
            ]);
        }

        for ( $i = 1; $i <= 5; $i++ )
        {
            DB::table('dictionaries')->insert([
                'category_id' => 2,
                'label' => 'Район №' . $i,
            ]);
        }
    }
}
