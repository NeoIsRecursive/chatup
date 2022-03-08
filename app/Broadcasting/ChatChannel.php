<?php

namespace App\Broadcasting;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User  $user
     * @return array|bool
     */
    public function join(User $user, Friendship $friendship)
    {
        //
        if ($user->id == $friendship->first_user || $user->id == $friendship->second_user) {
            return true;
        }
        return false;
    }
}
