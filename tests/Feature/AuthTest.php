<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function test_login()
    {
        $user = User::factory()->create();

        $response = $this->post('/api/auth/login',
            [
                'email' => $user->email,
                'password' => 'password'
            ]
        );

        $response->assertStatus(200)
            ->assertJson(['message' => 'success']);
    }

    public function test_register()
    {
        $response = $this->post('/api/auth/register', ['name' => 'newuser', 'email' => 'newuser@gmail.com', 'password' => 'password']);

        $response->assertStatus(201)->assertJson(['message' => 'success']);
    }

    public function test_login_fail()
    {
        $user = User::factory()->create();
        $response = $this->post('/api/auth/login', ['email' => $user->email, 'password' => 'wrong_password']);

        $response->assertStatus(401)
            ->assertJson(['message' => 'Incorrect email or password']);
    }
    
    public function test_logout()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user->createToken($user->name)->plainTextToken
        ])->post('/api/auth/logout');

        $response->assertStatus(200)->assertJson(['message' => 'success']);

        $this->assertCount(0, $user->tokens);
    }
}
