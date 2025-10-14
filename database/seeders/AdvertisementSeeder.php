<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ads = [
            [
                'title' => 'TechGlobal Solutions',
                'category' => 'Electronics & Gadgets',
                'discount_text' => '30% OFF',
                'period_text' => 'Limited Time',
                'banner_type' => 'svg',
                'icon_svg' => '<svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>',
                'gradient_from' => '#3b82f6',
                'gradient_to' => '#2563eb',
                'position' => 'homepage_carousel',
                'is_active' => true,
                'priority' => 5,
                'cta_text' => 'Shop Now',
                'cta_url' => '/products/electronics',
            ],
            [
                'title' => 'EcoLife Products',
                'category' => 'Home & Garden',
                'discount_text' => '25% OFF',
                'period_text' => 'This Week',
                'banner_type' => 'svg',
                'icon_svg' => '<svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M19 7h-8l-1-1H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h13c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2z"/></svg>',
                'gradient_from' => '#22c55e',
                'gradient_to' => '#16a34a',
                'position' => 'homepage_carousel',
                'is_active' => true,
                'priority' => 4,
                'cta_text' => 'Discover More',
                'cta_url' => '/categories/home-garden',
            ],
            [
                'title' => 'FashionForward',
                'category' => 'Apparel & Accessories',
                'discount_text' => '40% OFF',
                'period_text' => 'Flash Sale',
                'banner_type' => 'svg',
                'icon_svg' => '<svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>',
                'gradient_from' => '#a855f7',
                'gradient_to' => '#7e22ce',
                'position' => 'homepage_carousel',
                'is_active' => true,
                'priority' => 3,
                'cta_text' => 'View Styles',
                'cta_url' => '/categories/fashion',
            ],
            [
                'title' => 'SportPro Equipment',
                'category' => 'Sports & Fitness',
                'discount_text' => '35% OFF',
                'period_text' => 'New Year Sale',
                'banner_type' => 'svg',
                'icon_svg' => '<svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>',
                'gradient_from' => '#ef4444',
                'gradient_to' => '#b91c1c',
                'position' => 'homepage_carousel',
                'is_active' => true,
                'priority' => 2,
                'cta_text' => 'Shop Sports Gear',
                'cta_url' => '/categories/sports',
            ],
            [
                'title' => 'Digital Innovations',
                'category' => 'Software & Tools',
                'discount_text' => '50% OFF',
                'period_text' => 'Annual Deal',
                'banner_type' => 'svg',
                'icon_svg' => '<svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-5 14H4v-6h11v6zm0-7H4V9h11v2zm5 7h-4V9h4v9z"/></svg>',
                'gradient_from' => '#6366f1',
                'gradient_to' => '#4338ca',
                'position' => 'homepage_carousel',
                'is_active' => true,
                'priority' => 1,
                'cta_text' => 'Upgrade Now',
                'cta_url' => '/products/software',
            ],
        ];

        foreach ($ads as $ad) {
            Advertisement::create($ad);
        }
    }
}
