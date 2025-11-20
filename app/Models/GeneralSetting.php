<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class GeneralSetting extends Model
{
    protected $table = 'general_settings';

    protected $fillable = [
        'site_name',
        'site_tagline',
        'site_email',
        'site_phone',
        'banner_title',
        'banner_subtitle',

        // NEW: only ONE logo (public URL)
        'logo',           // stored as https://domain.com/images/logo.png
        'favicon',        // stored as https://domain.com/images/favicon.png

        // Banner / Hero Section
        'banner_image',         // URL for image
        'banner_mobile_image',  // URL for mobile image
        'banner_video',         // URL for video
        'banner_video_enabled', // boolean (true/false)

      

        // SEO
        'meta_title',
        'meta_description',
        'meta_keywords',

        // Socials
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'tiktok_url',
        'linkedin_url',
        'youtube_url',

        // Footer
        'footer_about',
        'footer_logo', // same logic: public URL

        // Cookie settings
        'cookie_enabled',
        'cookie_message',

        // Global settings
        'default_currency',
        'timezone',
        'storage_disk', // optional, if needed

        // Maintenance
        'maintenance_mode',
        'maintenance_message',

        // Extra JSON for new settings
        'extra',
    ];

    protected $casts = [
        'banner_video_enabled' => 'boolean',
        'cookie_enabled' => 'boolean',
        'maintenance_mode' => 'boolean',
        'extra' => 'array',
    ];

    /**
     * Singleton access for settings
     */
    public static function getSettings()
    {
        return Cache::rememberForever('general_settings', function () {
            return self::first() ?: self::create();
        });
    }

    /**
     * Update settings & refresh cache
     */
    public static function updateSettings(array $data)
    {
        $settings = self::getSettings();
        $settings->update($data);

        Cache::forget('general_settings');
        Cache::rememberForever('general_settings', fn() => $settings->fresh());

        return $settings;
    }

    /**
     * Active banner helper (image or video)
     */
    public function getActiveBannerAttribute()
    {
        if ($this->banner_video_enabled && $this->banner_video) {
            return [
                'type' => 'video',
                'path' => $this->banner_video,  // already public URL
            ];
        }

        return [
            'type' => 'image',
            'path' => $this->banner_image,
        ];
    }
}