<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StallAppointment extends Model
{
    //
    protected $fillable = ['stall_id',
        'seller_id',
        'seller_stall_id',
        'date',
        'status',
        'application_letter',
        'residency',
        'image',
        'id1',
        'id2'
    ];

    public function seller(){
        return $this->belongsTo( Seller::class);
    }

    public function stall(){
        return $this->belongsTo( Stall::class);
    }

    public function seller_stall(){
        return $this->belongsTo( SellerStall::class);
    }

}
