<?php

namespace Database\Seeders;

use App\Models\RnsuCategoryGroup;
use Illuminate\Database\Seeder;

class RnsuCategoryGroupSeeder extends Seeder
{
    public function run()
    {
        RnsuCategoryGroup::factory(10)->create();
    }
}
