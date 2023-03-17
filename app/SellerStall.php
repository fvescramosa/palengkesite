<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerStall extends Model
{
    //
    protected $fillable = [
        'stall_id',
        'status',
        'start_date',
        'end_date',
        'duration',
        'occupancy_fee',
        'seller_id',
        'status',
        'contact_of_lease',
        'type',
        'name'
    ];

    protected $dates = ['start_date', 'end_date'];


    public function seller(){
        return $this->belongsTo( Seller::class);
    }

    public function stall(){
        return $this->belongsTo( Stall::class);
    }

    public function stall_appointment(){
        return $this->hasOne( StallAppointment::class, 'seller_stall_id');
    }

    public function seller_stall_images(){
        return $this->hasMany(SellerStallImage::class);
    }
}
