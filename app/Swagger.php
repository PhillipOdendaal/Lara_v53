<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Swagger extends Model
{
    protected $hidden = [ 
        'token', 'admin', 'password'
    ];
}
