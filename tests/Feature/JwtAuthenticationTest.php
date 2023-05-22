<?php

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class JwtAuthenticationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function test_successful_jwt_authentication()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in',
        ]);

        $token = $response->json('access_token');

        $this->withHeader('Authorization', "Bearer {$token}")
            ->getJson('/api/user')
            ->assertOk()
            ->assertJson([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);

        $worker = \App\Models\Worker::factory()->create([
            'name' => 'Jhon Smith',
        ]);
        $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/reports', [
                'worker_id' => 1,
                'start_work' => '2023-05-21 20:00:12',
            ])
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'start_work' => '2023-05-21 20:00:12',
                ]
            ]);

        $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/reports/1', [
                '_method' => 'put',
                'worker_id' => 1,
                'start_work' => '2023-05-21 20:00:12',
                'end_work' => '2023-05-21 23:30:12',
            ])
            ->assertOk()
            ->assertJson([
                'data' => [
                    'start_work' => '2023-05-21 20:00:12',
                    'end_work' => '2023-05-21 23:30:12',
                ]
            ]);
    }

    /** @test */
    public function test_unauthenticated_request_returns_401()
    {
        $this->getJson('/api/user')->assertUnauthorized();
    }
}
