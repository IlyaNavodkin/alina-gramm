<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'user_id_from',
        'user_id_to',
        'status',
        'blocked',
    ];

    public function userFrom()
    {
        return $this->belongsTo(User::class, 'user_id_from');
    }

    public function userTo()
    {
        return $this->belongsTo(User::class, 'user_id_to');
    }
    public function messages()
    {
        return $this->hasMany(ContactsMessage::class);
    }
}
