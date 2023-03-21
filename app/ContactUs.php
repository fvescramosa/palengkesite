<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    //
    protected $fillable = [
        'subject',
        'to',
        'message',
        'from',
        'name',
    ];
}
