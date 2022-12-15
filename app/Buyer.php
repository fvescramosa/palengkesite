<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    //
    protected $fillable = [
        'birthday',
        'age',
        'gender',
        'contact',
        'stnumber',
        'stname',
        'city',
        'province',
        'country',
        'zip',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
