<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('advertisements')->insert([
            [
                'title' => 'TechGlobal Solutions',
                'category' => 'Electronics & Gadgets',
                'discount_text' => '30% OFF',
                'period_text' => 'Limited Time',
                'banner_type' => 'svg',
                'icon_svg' => '<svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>',
                'image_url' => null,
                'gradient_from' => '#3B82F6',
                'gradient_to' => '#2563EB',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'EcoLife Products',
                'category' => 'Home & Garden',
                'discount_text' => '25% OFF',
                'period_text' => 'This Week',
                'banner_type' => 'svg',
                'icon_svg' => '<svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M19 7h-8l-1-1H6a2 2 0 00-2 2v10a2 2 0 002 2h13a2 2 0 002-2V9a2 2 0 00-2-2z"/></svg>',
                'image_url' => null,
                'gradient_from' => '#10B981',
                'gradient_to' => '#059669',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'FashionForward',
                'category' => 'Apparel & Accessories',
                'discount_text' => '40% OFF',
                'period_text' => 'Flash Sale',
                'banner_type' => 'svg',
                'icon_svg' => '<svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>',
                'image_url' => null,
                'gradient_from' => '#8B5CF6',
                'gradient_to' => '#7C3AED',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'SportPro Equipment',
                'category' => 'Sports & Fitness',
                'discount_text' => '35% OFF',
                'period_text' => 'New Year Sale',
                'banner_type' => 'svg',
                'icon_svg' => '<svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>',
                'image_url' => null,
                'gradient_from' => '#EF4444',
                'gradient_to' => '#DC2626',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Digital Innovations',
                'category' => 'Software & Tools',
                'discount_text' => '50% OFF',
                'period_text' => 'Annual Deal',
                'banner_type' => 'image',
                'icon_svg' => null,
                'image_url' => 'https://via.placeholder.com/80x80.png?text=DI',
                'gradient_from' => null,
                'gradient_to' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'GreenEnergy Rwanda',
                'category' => 'Sustainability',
                'discount_text' => 'Up to 20% OFF',
                'period_text' => 'Eco Week',
                'banner_type' => 'color',
                'icon_svg' => null,
                'image_url' => null,
                'gradient_from' => '#16A34A',
                'gradient_to' => '#4ADE80',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
