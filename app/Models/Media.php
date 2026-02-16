<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $fillable = [
        'page_id',
        'title',
        'file',
        'type',
        'link',
        'thumbnail',
        'size'
    ];
}
