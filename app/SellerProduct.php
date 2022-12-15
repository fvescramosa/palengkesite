<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerProduct extends Model
{
    //

    protected $fillable = [
        'seller_id',
        'product_id',
        'price',
        'type',
    ];

    public function product(){
        return $this->belongsTo(Products::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }
}
