<?php

namespace Tests\Feature\Api\Client\V1;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use DatabaseMigrations;

    public function test_auth_user_can_get_his_company()
    {
        Artisan::call('db:seed');

        $this->postJson('/api/client/v1/users/login', [
            'login' => 'user1',
            'password' => '1234',
        ]);
        
        $company = Auth::user()->company;

        $response = $this->getJson('/api/client/v1/company');
        $response
            ->assertStatus(200)
            ->assertExactJson([
                'data.id' => $company->id,
                'data.name' => $company->name,
                'data.full_name' => $company->full_name,
    
                'data.owner' => $company->owner,
                'data.responsible' => $company->responsible,
    
                'data.organization_type_id' => $company->organization_type_id,
                'data.district_id' => $company->district_id,
    
                'data.is_has_education_license' => $company->is_has_education_license,
                'data.is_has_mdedical_license' => $company->is_has_mdedical_license,
                'data.is_has_innovative_platform' => $company->is_has_innovative_platform,
    
                'data.status' => $company->status,
                'data.rejected_status_description' => $company->rejected_status_description,
                
                'error' => null,
            ])
            ;
    }
}
