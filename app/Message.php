<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //

    protected $fillable = [
        'seller_id',
        'buyer_id',
        'message',
        'sender'
    ];

    public function seller(){
        return $this->belongsTo( Seller::class);
    }

    public function buyer(){
        return $this->belongsTo( Buyer::class);
    }
}
