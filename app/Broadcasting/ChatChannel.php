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
        if (Auth::id() == $friendship->first_user || Auth::id() == $friendship->second_user) {
            return true;
        }
        return false;
    }
}
