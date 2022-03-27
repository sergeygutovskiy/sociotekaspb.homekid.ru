<?php

namespace Tests\Feature\Api\Client\V1;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    private function insert_user($id, $login, $password)
    {
        DB::table('users')->insert([
            'id' => $id,
            'login' => $login,
            'password' => Hash::make($password),
        ]);
    }

    public function test_login_work_with_correct_payload()
    {
        $user_id = 1;
        $user_login = 'user1';
        $user_password = '1234';

        $this->insert_user($user_id, $user_login, $user_password);

        $response = $this->postJson('/api/client/v1/users/login', [
            'login' => $user_login,
            'password' => $user_password,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->whereAllType([
                'data.user.id' => 'integer',
                'data.user.login' => 'string',
                'data.user.is_admin' => 'boolean',
                'data.token.value' => 'string',
                'data.token.type' => 'string',
                'error' => 'null'
            ]))
            ;
    }

    public function test_login_not_work_with_wrong_password()
    {
        $user_id = 1;
        $user_login = 'user1';
        $user_password = '1234';

        $this->insert_user($user_id, $user_login, $user_password);

        $response = $this->postJson('/api/client/v1/users/login', [
            'login' => $user_login,
            'password' => '....',
        ]);

        $response
            ->assertStatus(404)
            ->assertJson(fn (AssertableJson $json) => $json->whereAllType([
                'data' => 'null',
                'error' => 'string'
            ]))
            ;
    }

    public function test_auth_check_work_with_correct_token()
    {
        $user_id = 1;
        $user_login = 'user1';
        $user_password = '1234';

        $this->insert_user($user_id, $user_login, $user_password);

        $response = $this->postJson('/api/client/v1/users/login', [
            'login' => $user_login,
            'password' => $user_password,
        ]);

        $response = $this->postJson('/api/client/v1/users/check');
        $response->assertStatus(200);
    }

    public function test_auth_check_not_work_with_wrong_token()
    {
        $user_id = 1;
        $user_login = 'user1';
        $user_password = '1234';

        $this->insert_user($user_id, $user_login, $user_password);

        $response = $this->postJson('/api/client/v1/users/check');
        $response->assertStatus(401);
    }
}
