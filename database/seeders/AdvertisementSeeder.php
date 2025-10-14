<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
                'brand_name' => 'TechGlobal Solutions',
                'category' => 'Electronics & Gadgets',
                'discount' => '30% OFF',
                'tagline' => 'Limited Time',
                'icon_svg' => '<svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" /></svg>',
                'gradient_from' => 'from-blue-500',
                'gradient_to' => 'to-blue-600',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand_name' => 'EcoLife Products',
                'category' => 'Home & Garden',
                'discount' => '25% OFF',
                'tagline' => 'This Week',
                'icon_svg' => '<svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M19 7h-8l-1-1H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h13c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2z" /></svg>',
                'gradient_from' => 'from-green-500',
                'gradient_to' => 'to-green-600',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand_name' => 'FashionForward',
                'category' => 'Apparel & Accessories',
                'discount' => '40% OFF',
                'tagline' => 'Flash Sale',
                'icon_svg' => '<svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" /></svg>',
                'gradient_from' => 'from-purple-500',
                'gradient_to' => 'to-purple-600',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand_name' => 'SportPro Equipment',
                'category' => 'Sports & Fitness',
                'discount' => '35% OFF',
                'tagline' => 'New Year Sale',
                'icon_svg' => '<svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" /></svg>',
                'gradient_from' => 'from-red-500',
                'gradient_to' => 'to-red-600',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand_name' => 'Digital Innovations',
                'category' => 'Software & Tools',
                'discount' => '50% OFF',
                'tagline' => 'Annual Deal',
                'icon_svg' => '<svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-5 14H4v-6h11v6zm0-7H4V9h11v2zm5 7h-4V9h4v9z" /></svg>',
                'gradient_from' => 'from-indigo-500',
                'gradient_to' => 'to-indigo-600',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
