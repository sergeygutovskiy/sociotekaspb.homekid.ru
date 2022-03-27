<?php

namespace Database\Seeders;

use App\Enums\CompanyStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    public function run()
    {
        DB::table('companies')->insert([
            'id' => 1,
            'user_id' => 1,
            'name' => 'Компания 1',
            'full_name' => 'Полное название компании',

            'owner' => 'Владелец',
            'responsible' => 'Ответственный',

            'organization_type_id' => 1,
            'district_id' => 1,

            'is_has_education_license' => true,
            'is_has_mdedical_license' => true,
            'is_has_innovative_platform' => false,

            'status' => CompanyStatus::Accepted,
        ]);

        DB::table('companies')->insert([
            'id' => 2,
            'user_id' => 2,
            'name' => 'Компания 2',
            'full_name' => 'Полное название компании',

            'owner' => 'Владелец',
            'responsible' => 'Ответственный',

            'organization_type_id' => 4,
            'district_id' => 1,

            'is_has_education_license' => true,
            'is_has_mdedical_license' => true,
            'is_has_innovative_platform' => true,

            'status' => CompanyStatus::Pending,
        ]);

        DB::table('companies')->insert([
            'id' => 3,
            'user_id' => 3,
            'name' => 'Компания 3',
            'full_name' => 'Полное название компании',

            'owner' => 'Владелец',
            'responsible' => 'Ответственный',

            'organization_type_id' => 3,
            'district_id' => 2,

            'is_has_education_license' => false,
            'is_has_mdedical_license' => false,
            'is_has_innovative_platform' => false,

            'status' => CompanyStatus::Rejected,
            'rejected_status_description' => 'Говно съело мочу.'
        ]);
    }
}
