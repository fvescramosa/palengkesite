<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    //
    protected $fillable = [
        'user_id',
        'status',
        'code'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
