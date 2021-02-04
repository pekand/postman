<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_project()
    {
        $response = $this->postJson('/api/login', [
                'username' => 'admin@admin',
                'password' => 'password'
            ]
        );

        $response->assertStatus(200);

        $accessToken = $response->decodeResponseJson()['access_token'];

        $response = $this->getJson('/api/projects', ['Authorization' => $accessToken]);

        $response->assertStatus(200);

        $response = $this->postJson('/api/project', [
            "name" => "project1",
        ], ['Authorization' => $accessToken]);

        $response->assertStatus(200);

        $this->assertArrayHasKey('project', $response);

        $this->assertArrayHasKey('id', $response['project']);

        $projectId = $response->decodeResponseJson()['project']['id'];

        $response = $this->putJson('/api/project/'.$projectId, [
            "name" => "project2",
        ], ['Authorization' => $accessToken]);

        $response->assertStatus(200);

        $response = $this->getJson('/api/project/'.$projectId, ['Authorization' => $accessToken]);

        $response->assertStatus(200);

        $response = $this->deleteJson('/api/project/'.$projectId, [], ['Authorization' => $accessToken]);

        $response->assertStatus(200);

        $response = $this->getJson('/api/logout', ['Authorization' => $accessToken]);

        $response->assertStatus(200);
    }
}
