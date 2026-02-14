<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $fillable = [

        'name',
        'file',
        'status',
        'description'

    ];

}
