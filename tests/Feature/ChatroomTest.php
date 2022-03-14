<?php

namespace Tests\Feature;

use App\Models\Friendship;
use App\Models\User;
use Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChatroomTest extends TestCase
{
    use RefreshDatabase;

    public function test_chatroom_route_as_guest()
    {
        $response = $this->get('/chat/1');

        $response->assertRedirect('/login');
    }

    public function test_chatroom_route_as_auth_user_with_invalid_unexisting_friendship()
    {
        $user = User::create([
            'name' => 'test',
            'password' => Hash::make('123'),
        ]);

        $response = $this->actingAs($user)->get('chat/1');

        $response->assertStatus(404);
    }

    public function test_chatroom_route_as_auth_user_with_invalid_unaccepted_friendship()
    {
        $user = User::create([
            'name' => 'test',
            'password' => Hash::make('123'),
        ]);

        $friendship = Friendship::create([
            'first_user' => 2,
            'second_user' => 3,
            'asking_user' => 2,
            'accepted' => false
        ]);

        $response = $this->actingAs($user)->followingRedirects()->get("/chat/$friendship->id");

        $response->assertSeeText('not your channel');
    }

    public function test_chatroom_route_as_auth_user_with_invalid_accepted_friendship()
    {
        $user = User::create([
            'name' => 'test',
            'password' => Hash::make('123'),
        ]);

        $friendship = Friendship::create([
            'first_user' => 2,
            'second_user' => 3,
            'asking_user' => 2,
            'accepted' => true
        ]);

        $response = $this->actingAs($user)->followingRedirects()->get("/chat/$friendship->id");

        $response->assertSeeText('not your channel');
    }

    public function test_chatroom_route_as_auth_user_with_valid_unaccepted_friendship()
    {
        $user = User::create([
            'name' => 'test',
            'password' => Hash::make('123'),
        ]);

        $friendship = Friendship::create([
            'first_user' => 1,
            'second_user' => 2,
            'asking_user' => 1,
            'accepted' => false
        ]);

        $response = $this->actingAs($user)->followingRedirects()->get("/chat/$friendship->id");

        $response->assertSeeText('not accepted yet');
    }


    public function test_chatroom_route_as_auth_user_with_valid_accepted_friendship()
    {
        $user = User::create([
            'name' => 'test',
            'password' => Hash::make('123'),
        ]);

        $friendship = Friendship::create([
            'first_user' => 1,
            'second_user' => 2,
            'asking_user' => 1,
            'accepted' => true
        ]);

        $response = $this->actingAs($user)->get("/chat/$friendship->id");

        $response->assertSeeText('chatroom');
    }
}
