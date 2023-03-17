<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerStallImage extends Model
{
    //

    protected $fillable= [
        'seller_stall_id',
        'image'
    ];


    public function seller_stall(){
        return $this->belongsTo(SellerStall::class);
    }


}
