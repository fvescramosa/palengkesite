<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //

    public function order_status(){
        return $this->hasMany(OrderStatus::class);
    }
}
