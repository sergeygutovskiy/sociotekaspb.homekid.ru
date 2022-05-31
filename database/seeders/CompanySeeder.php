<?php

namespace Database\Seeders;

use App\Enums\CompanyStatus;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    public function run()
    {
        DB::table('companies')->insert([
            'id' => 1,
            'user_id' => 1,
            
            'phone' => '+7 (911) 999-12-71',
            'site' => 'https://test.com',
            'email' => 'test@test.com',
            
            'name' => 'Компания 1',
            'full_name' => 'Полное название компании 1',

            'owner' => 'Владелец',
            'responsible' => 'Ответственный',
            'responsible_phone' => '+7 (911) 281-15-75',

            'organization_type_id' => 1,
            'district_id' => 1,

            'education_license' => json_encode([
                'number' => 1,
                'date' => Carbon::now()->toDateString(),
                'type' => 'Дошкольное образование',
            ]),
            'medical_license' => json_encode([
                'number' => 2,
                'date' => Carbon::now()->toDateString(),
            ]),
            'is_has_innovative_platform' => true,

            'status' => CompanyStatus::Accepted,
        ]);

        DB::table('companies')->insert([
            'id' => 2,
            'user_id' => 2,
            
            'phone' => '+7 (911) 999-12-71',
            'site' => 'https://test2.com',
            'email' => 'test@test2.com',
            
            'name' => 'Компания 2',
            'full_name' => 'Полное название компании 2',

            'owner' => 'Владелец 2',
            'responsible' => 'Ответственный 2',
            'responsible_phone' => '+7 (911) 281-15-75',

            'organization_type_id' => 2,
            'district_id' => 2,

            'education_license' => null,
            'medical_license' => null,
            'is_has_innovative_platform' => false,

            'status' => CompanyStatus::Accepted,
        ]);
    }
}
