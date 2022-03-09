<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_user',
        'second_user',
        'asking_user',
        'accepted',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
