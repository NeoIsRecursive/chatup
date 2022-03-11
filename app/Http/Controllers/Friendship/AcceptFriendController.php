<?php

namespace App\Http\Controllers\Friendship;

use App\Http\Controllers\Controller;
use App\Models\Friendship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AcceptFriendController extends Controller
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
            return back()->withErrors("how did you get here?");
        }
        $friendship->accepted = true;
        $friendship->save();

        return back();
    }
}
