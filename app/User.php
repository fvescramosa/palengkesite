<?php

namespace App;

use http\Message;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $date = ['deleted_at'];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'user_type_id',
        'profile_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function seller(){
        return $this->hasOne(Seller::class);
    }


    public function buyer(){
        return $this->hasOne(Buyer::class);
    }

    public function user_type(){
        return $this->belongsTo(UserType::class);
    }

    public function messages()
    {
        return $this->hasMany(\App\Message::class);
    }

    public function delivery_addresses(){
        return $this->hasMany(DeliveryAddress::class);
    }
}
