<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TodoTest extends TestCase
{
    protected User $user;
    protected string $token;
    protected $todos;
    use RefreshDatabase;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
        $this->token = $this->user->createToken($this->user->name)->plainTextToken;
        $this->todos = Todo::factory(10)->create(['user_id' => $this->user->id]);
    }

    public function test_get_all_todos()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->getJson('/api/todos');

        $response->assertStatus(200);
        $this->assertCount(10, $response->json()['data']);
    }

    public function test_get_one_todo_by_id()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->getJson('/api/todos/' . $this->todos[0]->id);

        $response->assertStatus(200)->assertJson(['message' => "success"]);
    }

    public function test_store_todo()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->postJson('/api/todos', ['name' => fake()->name, 'description' => fake()->text]);

        $response->assertStatus(201)->assertJson(['message' => "success"]);
    }

    public function test_update_todo()
    {

    }
}
