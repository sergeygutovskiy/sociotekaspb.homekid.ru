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
                'data' => [
                    'id' => $company->id,
                    'name' => $company->name,
                    'full_name' => $company->full_name,
        
                    'email' => $company->email,
                    'site' => $company->site,
                    'phone' => $company->phone,
    
                    'owner' => $company->owner,
                    'responsible' => $company->responsible,
                    'responsible_phone' => $company->responsible_phone,
        
                    'organization_type_id' => $company->organization_type_id,
                    'district_id' => $company->district_id,
        
                    'education_license' => $company->education_license,
                    'medical_license' => $company->medical_license,
                    
                    'is_has_innovative_platform' => $company->is_has_innovative_platform,
        
                    'status' => $company->status,
                    'rejected_status_description' => $company->rejected_status_description,
                ],
                
                'error' => null,
            ])
        ;
    }

    public function test_auth_user_can_update_his_company()
    {
        Artisan::call('db:seed');

        $this->postJson('/api/client/v1/users/login', [
            'login' => 'user1',
            'password' => '1234',
        ]);
        
        $response = $this->putJson('/api/client/v1/company', [
            'name' => 'test',
            'full_name' => 'test',
            'email' => 'test',
            'site' => 'test',
            'phone' => 'test',
            'owner' => 'test',
            'responsible' => 'test',
            'responsible_phone' => 'test',
            'organization_type_id' => 1,
            'district_id' => 1,
            'education_license' => null,
            'medical_license' => null,
            'is_has_innovative_platform' => false,
        ]);

        $response->assertStatus(200)->assertJson([
            'data' => null,
            'error' => null,
        ]);

        $response = $this->putJson('/api/client/v1/company', [
            'name' => 'test',
            'full_name' => 'test',
            'email' => 'test',
            'site' => 'test',
            'phone' => 'test',
            'owner' => 'test',
            'responsible' => 'test',
            'responsible_phone' => 'test',
            'organization_type_id' => 1,
            'district_id' => 1,
            'education_license' => [
                'number' => 1,
                'date' => '05.05.2020',
                'type' => 'test'
            ],
            'medical_license' => [
                'number' => 1,
                'date' => '05.05.2020',
            ],
            'is_has_innovative_platform' => false,
        ]);

        $response->assertStatus(200)->assertJson([ 
            'data' => null,
            'error' => null,
        ]);
    }

    public function test_auth_user_cant_update_his_company_with_incorrect_input()
    {
        Artisan::call('db:seed');

        $this->postJson('/api/client/v1/users/login', [
            'login' => 'user1',
            'password' => '1234',
        ]);
        
        $response = $this->putJson('/api/client/v1/company', [
            'name' => 'test',
            'full_name' => 'test',
            'email' => 'test',
            'site' => 'test',
            'phone' => 'test',
            'owner' => 'test',
            'responsible' => 'test',
            'responsible_phone' => 'test',
            'organization_type_id' => 1,
            'district_id' => 1,
            'is_has_innovative_platform' => false,
        ]);

        $response->assertStatus(400)->assertJsonFragment([ 'data' => null ]);

        //

        $response = $this->putJson('/api/client/v1/company', [
            'name' => 'test',
            'full_name' => 'test',
            'email' => 'test',
            'site' => 'test',
            'phone' => 'test',
            'owner' => 'test',
            'responsible' => 'test',
            'responsible_phone' => 'test',
            'organization_type_id' => 1,
            'district_id' => 1,
            'education_license' => [],
            'medical_license' => [],
            'is_has_innovative_platform' => false,
        ]);

        $response->assertStatus(400)->assertJsonFragment([ 'data' => null ]);
    }
}
