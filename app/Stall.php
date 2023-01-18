<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stall extends Model
{
    //
    protected $fillable = [
        'number',
        'sqm',
        'amount_sqm',
        'rental_fee',
        'section',
        'market_id',
        'image',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
        'status',
    ];

    public function seller_stall(){
        return $this->hasOne( SellerStall::class, 'stall_id');
    }

    public function market(){
        return $this->belongsTo( Market::class);
    }
}
