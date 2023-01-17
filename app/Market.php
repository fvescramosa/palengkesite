<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    public function seller(){
        return $this->belongsTo( Seller::class);
    }

    public function stall(){
        return $this->belongsTo( Stall::class);
    }
}
