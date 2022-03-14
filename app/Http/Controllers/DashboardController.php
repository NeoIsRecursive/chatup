<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        //
        // dd(Auth::user()->friendships);

        $friends = Auth::user()->friendships()
            ->join('users as second', 'second.id', '=', 'friendships.second_user')
            ->join('users as first', 'first.id', '=', 'friendships.first_user')
            ->select([
                'friendships.id as id',
                'first.name as first_name',
                'second.name as second_name',
                'accepted',
                'asking_user'
            ])
            ->simplePaginate(10);

        $friends->map(function ($x) {
            $friend_name = Auth::user()->name === $x['second_name'] ? $x['first_name'] : $x['second_name'];
            $x->name = $friend_name;
            return $x;
        })->sort(function ($a, $b) {
            return $b->accepted <=> $a->accepted;
        });
        // usort($friends, function ($a, $b) {
        //     return $b['accepted'] <=> $a['accepted'];
        // });

        return view('dashboard')->with('friends', $friends);
    }
}
