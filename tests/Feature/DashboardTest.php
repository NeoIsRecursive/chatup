<?php

namespace Tests\Feature;

use App\Models\User;
use Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_index_route_as_guest()
    {
        $response = $this->get('/');

        $response->assertRedirectContains('login');
    }

    public function test_index_route_as_auth_user()
    {

        $user = User::create([
            'name' => 'test',
            'password' => Hash::make('123'),
        ]);

        $response = $this->actingAs($user)->followingRedirects()->get('/');

        $response->assertSeeText($user->name);
    }
}
