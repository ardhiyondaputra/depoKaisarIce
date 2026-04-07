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
        'status'
    ];

    protected $hidden = [
        'password'
    ];
}
