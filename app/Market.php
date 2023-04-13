<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $fillable = [
        'market'
    ];

    public function seller(){
        return $this->hasOne( Seller::class);
    }

    public function stall(){
        return $this->hasMany( Stall::class);
    }
}
