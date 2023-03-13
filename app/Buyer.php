<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'birthday',
        'age',
        'gender',
        'contact',
        'stnumber',
        'stname',
        'barangay',
        'city',
        'province',
        'country',
        'zip',
        'longitude',
        'latitude',
        'user_id',
        'image',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function carts(){
        return $this->hasMany(Cart::class );
    }

    public function orders(){
        return $this->hasMany(Order::class );
    }

    public function order_products(){
        return $this->hasMany(OrderProduct::class );
    }

    public function comments(){
        return $this->hasMany(Comments::class );
    }
/*
    public function delivery_addresses(){
        return $this->hasMany(DeliveryAddress::class );
    }*/

}
