<?php

namespace App\Http\Controllers\Messages;

use App\Events\TestMessage;
use App\Http\Controllers\Controller;
use App\Models\Friendship;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewMessageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Friendship $friendship)
    {

        $validated = $request->validate([
            'content' => ['required'],
        ]);

        $message = Message::create([
            'friendship_id' => $friendship->id,
            'content' => $validated['content'],
            'user_id' => Auth::id(),
        ]);

        event(new TestMessage($message));
        return response(['sent message']);
    }
}
