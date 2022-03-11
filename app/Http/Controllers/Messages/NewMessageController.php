<?php

namespace App\Http\Controllers\Messages;

use App\Events\TestMessage;
use App\Http\Controllers\Controller;
use App\Models\Friendship;
use App\Models\Message;
use Crypt;
use Illuminate\Encryption\Encrypter;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
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
            'content' => Crypt::encryptString($validated['content']),
            'user_id' => Auth::id(),
        ]);

        event(new TestMessage($message));
        return response(true);
    }
}
