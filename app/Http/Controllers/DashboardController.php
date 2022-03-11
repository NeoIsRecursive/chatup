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
        $friends = Auth::user()->friendships();
        usort($friends, function ($a, $b) {
            return $b['accepted'] <=> $a['accepted'];
        });

        return view('dashboard')->with('friends', $friends);
    }
}
