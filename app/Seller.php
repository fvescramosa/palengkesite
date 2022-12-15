<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    //

    protected $fillable = [
        'birthday',
        'age',
        'gender',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function seller_stalls(){
        return $this->hasOne( SellerStall::class);
    }

    public function seller_products(){
        return $this->hasMany( SellerProduct::class);
    }

    public function stall_appointments(){
        return $this->hasMany( StallAppointment::class);
    }
}
