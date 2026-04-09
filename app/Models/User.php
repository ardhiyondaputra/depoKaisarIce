<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user';

    protected $primaryKey = 'id_user';

    public $incrementing = true;

    protected $fillable = [
    'username',
    'password',
    'role',
    'status',
    'recovery_key',
    'must_change_password'
];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    protected $attributes = [
        'status' => 'aktif',
    ];
}