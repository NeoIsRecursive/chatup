<?php

use App\Broadcasting\ChatChannel;
use App\Models\Friendship;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{friendshipId}', function ($user, $friendshipId) {
    $friendship = Friendship::find($friendshipId);

    return $user->id === $friendship->first_user  || $user->id === $friendship->second_user;
});
