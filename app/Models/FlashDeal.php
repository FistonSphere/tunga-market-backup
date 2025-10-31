<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class FlashDeal extends Model
{
    protected $fillable = [
        'product_id',
        'flash_price',
        'discount_percent',
        'start_time',
        'end_time',
        'stock_limit',
        'is_active', // stores 'Active' or 'Inactive'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time'   => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Scope that returns DB rows considered currently active (based on column + time window)
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 'Active')
                     ->where('start_time', '<=', now())
                     ->where('end_time', '>=', now());
    }

    /**
     * Runtime computed status without modifying DB.
     * Returns 'Active' or 'Inactive' based on current time and start/end times.
     */
    public function getCurrentStatusAttribute()
    {
        // If there is no end_time/start_time, fallback to DB column
        if (!$this->start_time || !$this->end_time) {
            return $this->is_active;
        }

        $now = Carbon::now();

        if ($now->between($this->start_time, $this->end_time)) {
            return 'Active';
        }

        return 'Inactive';
    }

    /**
     * Utility to synchronize DB: mark expired deals as 'Inactive' and mark current period deals as 'Active'.
     * Call this from an artisan command or scheduler.
     */
    public static function syncStatusesToDatabase(): array
    {
        $results = ['set_inactive' => 0, 'set_active' => 0];

        // 1) expire old deals
        $expiredQuery = static::where('end_time', '<', now())->where('is_active', 'Active');
        $results['set_inactive'] = $expiredQuery->count();
        $expiredQuery->update(['is_active' => 'Inactive']);

        // 2) activate deals that are within start..end but DB flagged inactive
        $activateQuery = static::where('start_time', '<=', now())
                                   ->where('end_time', '>=', now())
                                   ->where('is_active', 'Inactive');
        $results['set_active'] = $activateQuery->count();
        $activateQuery->update(['is_active' => 'Active']);

        Log::info('FlashDeal::syncStatusesToDatabase', $results);

        return $results;
    }
}
