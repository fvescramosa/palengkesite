<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $fillable = [
        'id',
        'title',
        'description',
        'user_id',
        'status',
        'product_id',
        'type',
    ];


}
