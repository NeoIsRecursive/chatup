<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Crypt;
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
        if (Auth::id() !== $friendship->first_user  && Auth::id() !== $friendship->second_user) {
            return back()->withErrors("not your channel");
        }

        $otheruser = User::find(Auth::id() !== $friendship->first_user ? $friendship->first_user : $friendship->secpnd_user);

        $messages = $friendship->messages;

        $messages->getCollection()->reverse()->map(function ($x) use ($otheruser) {
            $x->user_name = Auth::id() == $x->user_id ? Auth::user()->name : $otheruser->name;
            $x->content = Crypt::decryptString($x->content);
            return $x;
        });

        return view('chat_room')->with('messages', $messages);
    }
}
