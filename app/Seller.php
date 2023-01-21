<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    //

    use SoftDeletes;

    protected $fillable = [
        'birthday',
        'age',
        'gender',
        'user_id',
        'seller_type',
        'market_id',
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

    public function market(){
        return $this->belongsTo( Market::class);
    }

}
