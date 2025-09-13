<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comparison extends Model
{
   protected $fillable = ['user_id', 'product_ids'];

    protected $casts = [
        'product_ids' => 'array',
    ];
}
