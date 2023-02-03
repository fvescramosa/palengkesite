<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use SoftDeletes;
    //
    use Notifiable;
    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password', 'is_super'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}
