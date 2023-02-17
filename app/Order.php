<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    protected $fillable = [
        'buyer_id',
        'seller_id',
        'transaction_id',
        'total'
    ];


    public function order_products(){
        return $this->hasMany(OrderProduct::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function buyer(){
        return $this->belongsTo(Buyer::class);
    }

    public function order_delivery_detail(){
        return $this->hasOne(OrderDeliveryDetail::class);
    }
}
