<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{

    protected $fillable = [

        'name',
        'designation',
        'company',
        'content',
        'rating',
        'status'

    ];
}
