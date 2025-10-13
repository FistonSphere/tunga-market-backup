<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'title',
        'category',
        'discount_text',
        'period_text',
        'banner_type',
        'icon_svg',
        'image_url',
        'gradient_from',
        'gradient_to',
    ];

    
}
