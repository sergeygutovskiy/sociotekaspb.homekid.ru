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
}
