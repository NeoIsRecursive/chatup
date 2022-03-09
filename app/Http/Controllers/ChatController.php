<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use Illuminate\Http\Request;

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
        //

        $messages = $friendship->messages;

        return view('chat_room')->with('messages', $messages);
    }
}
