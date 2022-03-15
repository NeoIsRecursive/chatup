<?php

namespace App\Http\Controllers\Friendship;

use App\Http\Controllers\Controller;
use App\Models\Friendship;
use Auth;
use Illuminate\Http\Request;

class RemoveFriendController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Friendship $friendship)
    {
        if (Auth::id() !== $friendship->first_user  && Auth::id() !== $friendship->second_user) {
            return back()->withErrors("how did you get here?");
        }

        $friendship->messages()->delete();

        $friendship->delete();

        return back();
    }
}
