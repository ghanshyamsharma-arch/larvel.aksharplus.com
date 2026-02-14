<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'tagline',
        'title',
        'highlight_text',
        'description',
        'button_text',
        'button_link',
        'image'
    ];
}
