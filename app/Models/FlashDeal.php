<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlashDeal extends Model
{
    protected $fillable = [
        'product_id', 'flash_price', 'discount_percent',
        'start_time', 'end_time', 'stock_limit', 'is_active'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where('start_time', '<=', now())
            ->where('end_time', '>=', now());
    }
}
