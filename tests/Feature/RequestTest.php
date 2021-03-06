<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RequestTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_request()
    {
        $response = $this->getJson('/api/requests/1');
        $response->assertStatus(403);

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

        $projectId = $response->decodeResponseJson()['project']['id'];

        ////////////////////////////////////////////

        $response = $this->getJson('/api/requests/'.$projectId, ['Authorization' => $accessToken]);

        $response->assertStatus(200);

        $response = $this->postJson('/api/request', [
            'name' => 'requestInserted',
            'url' => 'https://postman.project.dev',
            'method' => 'get',
            'params' => '{}',
            'project_id' => $projectId,
        ], ['Authorization' => $accessToken]);

        $response->assertStatus(200);

        $this->assertArrayHasKey('request', $response);

        $this->assertArrayHasKey('id', $response['request']);

        $requestId = $response->decodeResponseJson()['request']['id'];

        $response = $this->putJson('/api/request/'.$requestId, [
            'name' => 'requestUpdated',
            'url' => 'https://postman.project.dev',
            'method' => 'get',
            'params' => '{}',
            'project_id' => $projectId,
        ], ['Authorization' => $accessToken]);

        $response->assertStatus(200);

        $response = $this->getJson('/api/request/'.$requestId, ['Authorization' => $accessToken]);

        $response->assertStatus(200);

        $response = $this->deleteJson('/api/request/'.$requestId, [], ['Authorization' => $accessToken]);

        $response->assertStatus(200);

        /////////////////////////////////

        $response = $this->deleteJson('/api/project/'.$projectId, [], ['Authorization' => $accessToken]);

        $response->assertStatus(200);

        $response = $this->getJson('/api/logout', ['Authorization' => $accessToken]);

        $response->assertStatus(200);
    }
}
