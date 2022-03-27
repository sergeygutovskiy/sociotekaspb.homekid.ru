<?php

namespace Tests\Feature\Api\Client\V1;

use App\Models\DictionaryCategory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class DictionaryCategoryTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_get_category_dictionaries()
    {
        Artisan::call('db:seed');

        $this->postJson('/api/client/v1/users/login', [
            'login' => 'user1',
            'password' => '1234',
        ]);

        $category = DictionaryCategory::first();
        
        $response = $this->getJson('/api/client/v1/dictionary-categories/' . $category->slug . '/dictionaries');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'label',
                    ],
                ]
            ])
            ;
    }
}
