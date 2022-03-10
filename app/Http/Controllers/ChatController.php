<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Friendship $friendship, Request $request)
    {
        if (Auth::id() !== $friendship->first_user  && Auth::id() !== $friendship->second_user)
            return abort(404, "not your channel");

        $messages = $friendship->messages;

        return view('chat_room')->with('messages', $messages);
    }
}
