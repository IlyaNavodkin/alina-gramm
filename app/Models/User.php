<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;

class User extends AuthenticatableUser implements Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'email',
        'phone',
        'password',
        'banned',
        'roles',
        'login',
        'avatar',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'banned' => 'boolean',
    ];
    public function chats()
    {
        // return $this->hasMany(Chat::class, 'owner_id');
        return $this->belongsToMany(Chat::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function contacts()
    {
        return $this->belongsToMany(User::class, 'contacts', 'user_id_from', 'user_id_to');
    }
}
