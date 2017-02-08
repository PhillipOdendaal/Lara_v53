<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Support\Facades\Input;

class txProject extends Model
{
    //use FormAccessible;
    
    protected $casts = [
        'snapshot' => 'snapshot'
    ];
    
    protected $fillable = ['txid'];
}
