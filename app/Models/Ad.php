<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'media_url',
        'badge',
        'cta_text',
        'extra_info',
        'type',
        'link',
        'order',
    ];
}
