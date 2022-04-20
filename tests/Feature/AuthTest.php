<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_is_possible_register_a_user()
    {
        $user = User::factory()->make();
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password
        ];

        $response = $this->json('POST', '/api/register', $data);
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'user registered succesfully'
        ]);
    }

    public function test_if_is_possible_make_login_with_a_valide_user()
    {
        $data = [
            'email' => 'davi@teste.com',
            'password' => '12345678'
        ];

        $response = $this->json('POST', '/api/login', $data);
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);
    }
}
