<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    //
    protected $fillable = [
        'stnumber',
        'stname',
        'barangay',
        'city',
        'province',
        'country',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
