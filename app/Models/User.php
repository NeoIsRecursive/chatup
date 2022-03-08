<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // friendship that this user started
    protected function friendsOfThisUser()
    {
        return $this->belongsToMany(User::class, 'friendships', 'first_user', 'second_user')
            ->withPivot('accepted');
    }

    // friendship that this user was asked for
    protected function thisUserFriendOf()
    {
        return $this->belongsToMany(User::class, 'friendships', 'second_user', 'first_user')
            ->withPivot('accepted');
    }

    public function friends()
    {

        dd($this->friendsOfThisUser->merge($this->thisUserFriendOf)->first());
    }

    public function friendships()
    {
        $values = [
            'friendships.id as friendship_id',
            'first.name as first_name',
            'second.name as second_name',
            'accepted'
        ];

        $friendships = Friendship::select($values)
            ->where('first_user', Auth::id())
            ->orWhere('second_user', Auth::id())
            ->join('users as second', 'second.id', '=', 'friendships.second_user')
            ->join('users as first', 'first.id', '=', 'friendships.first_user')
            ->get()->toArray();

        $friendships = array_map(function ($x) {
            $friend_name = Auth::user()->name === $x['second_name'] ? $x['first_name'] : $x['second_name'];
            $x['friend_name'] = $friend_name;
            return [
                "id" => $x['friendship_id'],
                "accepted" => $x['accepted'],
                "name" => $friend_name,
            ];
        }, $friendships);
        return $friendships;
    }
}
