<?php

namespace App\Http\Controllers\Friendship;

use App\Http\Controllers\Controller;
use App\Models\Friendship;
use App\Models\User;
use Crypt;
use Hash;
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
            return back()->withErrors('That user doesnt exist exist');
        }

        $data = Friendship::select('id')
            ->where(function ($query) use ($second_user) {
                $query->where('first_user', Auth::id());
                $query->where('second_user', $second_user->id);
            })
            ->orWhere(function ($query) use ($second_user) {
                $query->where('first_user', $second_user->id);
                $query->where('second_user', Auth::id());
            })
            ->get();

        if ($data->isEmpty()) {
            Friendship::create([
                'first_user' => Auth::id(),
                'second_user' => $second_user->id,
                'asking_user' => Auth::id(),
            ]);
            return back();
        }


        return back()->withErrors('There already exists a pending request');
    }
}
