<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Developer extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'name',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'photo',
    ];
}
