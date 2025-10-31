<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    // Relationship
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Active deals scope
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                     ->where('start_time', '<=', now())
                     ->where('end_time', '>=', now());
    }

    // Automatically check expiry when fetching
    protected static function booted()
    {
        static::retrieved(function ($deal) {
            $deal->checkAndDeactivateIfExpired();
        });

        static::saving(function ($deal) {
            $deal->checkAndDeactivateIfExpired();
        });
    }

    /**
     * Check if the deal has expired and deactivate if necessary
     */
    public function checkAndDeactivateIfExpired()
    {
        if ($this->end_time instanceof Carbon && $this->end_time->isPast() && $this->is_active) {
            $this->is_active = false;
            $this->saveQuietly(); // Save silently to prevent infinite loop
        }
    }
}
