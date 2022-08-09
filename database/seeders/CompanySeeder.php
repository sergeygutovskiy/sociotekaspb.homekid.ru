<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run()
    {
        $users = User::where('is_admin', false)->get();
        $users->each(fn($user) => Company::factory()->for($user)->create());
    }
}
