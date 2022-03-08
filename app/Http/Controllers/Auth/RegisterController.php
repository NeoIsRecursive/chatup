<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validate = $request->validate(
            [
                'name' => ['required', 'string', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'confirmed']
            ]
        );

        $user = User::create([
            'name' => $validate['name'],
            'password' => Hash::make($validate['password']),
        ]);

        Auth::loginUsingId($user->id);

        return redirect('/');
    }
}
