<?php

namespace Tests\Feature;

use App\Models\User;
use Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_route_as_guest()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_login_route_as_auth_user()
    {
        $user = User::create([
            'name' => 'test',
            'password' => Hash::make('123'),
        ]);

        $response = $this->actingAs($user)->get('login');

        $response->assertRedirectContains('/');
    }
}
