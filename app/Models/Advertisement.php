<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'description',
        'banner_type',
        'icon_svg',
        'image_url',
        'video_url',
        'gradient_from',
        'gradient_to',
        'position',
        'is_active',
        'start_date',
        'end_date',
        'discount_text',
        'period_text',
        'cta_text',
        'cta_url',
        'priority',
        'clicks',
        'impressions',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Scope for active ads only (based on time and status)
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', Carbon::now());
            })
            ->where(function ($q) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', Carbon::now());
            });
    }

    /**
     * Scope for homepage carousel ads
     */
    public function scopeHomepage($query)
    {
        return $query->where('position', 'homepage_carousel');
    }

    /**
     * Increment click count
     */
    public function incrementClicks()
    {
        $this->increment('clicks');
    }

    /**
     * Increment impression count
     */
    public function incrementImpressions()
    {
        $this->increment('impressions');
    }

    /**
     * Accessor for default gradient
     */
    public function getGradientStyleAttribute()
    {
        $from = $this->gradient_from ?? '#ccc';
        $to = $this->gradient_to ?? '#999';
        return "background: linear-gradient(to bottom right, {$from}, {$to});";
    }
}
