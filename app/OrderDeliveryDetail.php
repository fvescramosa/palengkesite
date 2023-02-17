<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDeliveryDetail extends Model
{
    //
    protected $fillable = [
        'stnumber',
        'stname',
        'barangay',
        'city',
        'province',
        'country',
        'buyer_id',
        'order_id',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function buyer(){
        return $this->belongsTo(Buyer::class);
    }
}
