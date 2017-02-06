<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $casts = [
        'field_name' => 'project_data'
    ];
}
