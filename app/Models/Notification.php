<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_id',
        'type',
        'title',
        'message',
        'data',
        'is_read',
        'action_time',
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'action_time' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // --- Scopes ---

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    // --- Analytics helpers ---

    public static function countByPeriod($period = '7days')
    {
        $from = match ($period) {
            '7days' => now()->subDays(7),
            '28days' => now()->subDays(28),
            'year' => now()->subYear(),
            default => now()->subDays(7),
        };

        return static::where('created_at', '>=', $from)->count();
    }

    public static function growthComparison($period1 = '7days', $period2 = '28days')
    {
        $count1 = static::countByPeriod($period1);
        $count2 = static::countByPeriod($period2);

        if ($count2 == 0) return null;

        return round((($count1 - $count2) / $count2) * 100, 2);
    }

    // --- Actions ---

    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }
}
