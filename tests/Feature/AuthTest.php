<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_auth()
    {
        $response = $this->postJson('/api/login', [
                'username' => 'admin@admin',
                'password' => 'password'
            ]
        );

        $response->assertStatus(200);

        $this->assertArrayHasKey('access_token', $response);

        $accessToken = $response->decodeResponseJson()['access_token'];

        $response = $this->getJson('/api/logout', ['Authorization' => $accessToken]);

        $response->assertStatus(200);
    }
}
