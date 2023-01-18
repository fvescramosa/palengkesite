<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    public function seller(){
        return $this->hasOne( Seller::class);
    }

    public function stall(){
        return $this->hasMany( Stall::class);
    }
}
