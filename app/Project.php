<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $casts = [
        'field_name' => 'task_set'
    ];
}
