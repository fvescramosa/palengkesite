<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    //

    protected $fillable = [
        'order_id',
        'product_id',
        'buyer_id',
        'seller_id',
        'seller_product_id',
        'quantity',
        'total'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function product(){
        return $this->belongsTo(Products::class);
    }

    public function buyer(){
        return $this->belongsTo(Buyer::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function seller_product(){
        return $this->belongsTo(SellerProduct::class);
    }
}
