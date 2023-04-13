<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Stall extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'number',
        'sqm',
        'amount_sqm',
        'rental_fee',
        'section',
        'market_id',
        'image',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
        'status',
        'rate',
        'coords',
        'meter_num',
        'category_id',
        'annual_fee',
    ];

    public function seller_stall(){
        return $this->hasOne( SellerStall::class, 'stall_id');
    }

    public function market(){
        return $this->belongsTo( Market::class);
    }

    public function category(){
        return $this->belongsTo(Categories::class );
    }
}
