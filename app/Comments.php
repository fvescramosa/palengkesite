<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comments extends Model
{
    //

    protected $fillable = [
        'product_id',
        'seller_product_id',
        'is_anonymous',
        'comment',
        'ratings',
        'buyer_id',
    ];


    public function seller_products(){
        return $this->belongsTo(SellerProduct::class);
    }

    public function buyer(){
        return $this->belongsTo(Buyer::class);
    }
}
