<?php

namespace App\Http\Controllers\Friendship;

use App\Http\Controllers\Controller;
use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddFriendController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
        $validated = $request->validate([
            'friend' => ['required']
        ]);

        $second_user = User::where('name', $validated['friend'])->first();
        if ($second_user === null || Auth::id() === $second_user->id) {
            return back();
        }

        Friendship::create([
            'first_user' => Auth::id(),
            'second_user' => $second_user->id,
            'asking_user' => Auth::id(),
        ]);
    }
}
