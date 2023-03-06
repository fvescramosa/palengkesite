<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'category',
        'image',
    ];
    public function products(){
        return $this->hasMany(Products::class);
    }
}
