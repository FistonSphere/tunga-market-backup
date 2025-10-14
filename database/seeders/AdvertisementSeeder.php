<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Advertisement;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ads = [
            // 1️⃣ Gradient + SVG Ad (Tech)
            [
                'title' => 'TechGlobal Solutions',
                'category' => 'Electronics & Gadgets',
                'discount_text' => '30% OFF',
                'period_text' => 'Limited Time',
                'banner_type' => 'svg',
                'icon_svg' => '<svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>',
                'gradient_from' => '#3b82f6',
                'gradient_to' => '#2563eb',
                'image_url' => null,
                'position' => 'homepage_carousel',
                'is_active' => true,
                'priority' => 5,
                'cta_text' => 'Shop Now',
                'cta_url' => '/products/electronics',
            ],

            // 2️⃣ Image Banner (Fashion cover poster)
            [
                'title' => 'Summer Fashion Sale',
                'category' => 'Apparel & Accessories',
                'discount_text' => 'Up to 60% OFF',
                'period_text' => 'Ends Soon!',
                'banner_type' => 'image',
                'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR741NuB-nHcTsibEAD60w3XH1A6-FMwW-r-A&s', // e.g. /public/storage/ads/
                'gradient_from' => null,
                'gradient_to' => null,
                'icon_svg' => null,
                'position' => 'homepage_hero',
                'is_active' => true,
                'priority' => 6,
                'cta_text' => 'Explore Styles',
                'cta_url' => '/categories/fashion',
            ],

            // 3️⃣ Image Poster (Home appliances promo)
            [
                'title' => 'Home Essentials Deals',
                'category' => 'Home & Kitchen',
                'discount_text' => 'Save Big on Appliances',
                'period_text' => 'This Month Only',
                'banner_type' => 'image',
                'image_url' => 'https://www.shutterstock.com/image-vector/powerful-sunscreen-product-banner-water-260nw-1502049644.jpg',
                'gradient_from' => null,
                'gradient_to' => null,
                'icon_svg' => null,
                'position' => 'homepage_section_banner',
                'is_active' => true,
                'priority' => 4,
                'cta_text' => 'Shop Appliances',
                'cta_url' => '/categories/home-appliances',
            ],

            // 4️⃣ Gradient + SVG (Sports)
            [
                'title' => 'SportPro Equipment',
                'category' => 'Sports & Fitness',
                'discount_text' => '35% OFF',
                'period_text' => 'New Year Sale',
                'banner_type' => 'svg',
                'icon_svg' => '<svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M20 6a8 8 0 11-8-8 8 8 0 018 8z"/></svg>',
                'gradient_from' => '#ef4444',
                'gradient_to' => '#b91c1c',
                'image_url' => null,
                'position' => 'homepage_carousel',
                'is_active' => true,
                'priority' => 3,
                'cta_text' => 'Shop Sports Gear',
                'cta_url' => '/categories/sports',
            ],

            // 5️⃣ Full-width Image Ad (Tech Poster)
            [
                'title' => 'Next-Gen Laptops',
                'category' => 'Computers',
                'discount_text' => 'Save up to $200',
                'period_text' => 'Limited Offer',
                'banner_type' => 'image',
                'image_url' => 'https://indiater.com/wp-content/uploads/2022/06/download-free-shoe-ad-banner-web-advertising-designs-theme-psd-templates.jpg',
                'gradient_from' => null,
                'gradient_to' => null,
                'icon_svg' => null,
                'position' => 'homepage_poster',
                'is_active' => true,
                'priority' => 2,
                'cta_text' => 'Get Yours Now',
                'cta_url' => '/categories/laptops',
            ],

            // 6️⃣ Gradient + SVG (Software & Tools)
            [
                'title' => 'Digital Innovations',
                'category' => 'Software & Tools',
                'discount_text' => '50% OFF',
                'period_text' => 'Annual Deal',
                'banner_type' => 'svg',
                'icon_svg' => '<svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4v16h16V4z"/></svg>',
                'gradient_from' => '#6366f1',
                'gradient_to' => '#4338ca',
                'image_url' => null,
                'position' => 'homepage_carousel',
                'is_active' => true,
                'priority' => 1,
                'cta_text' => 'Upgrade Now',
                'cta_url' => '/products/software',
            ],

            // 7️⃣ Image Cover Ad (Black Friday)
            [
                'title' => 'Black Friday Mega Sale',
                'category' => 'All Categories',
                'discount_text' => 'Everything Up to 80% OFF',
                'period_text' => 'Only This Week',
                'banner_type' => 'image',
                'image_url' => 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/new-shoes-collection-sale-poster-design-template-6d5c4a8cd62d655ea88416be95951744_screen.jpg?ts=1649517884',
                'gradient_from' => null,
                'gradient_to' => null,
                'icon_svg' => null,
                'position' => 'homepage_cover',
                'is_active' => true,
                'priority' => 10,
                'cta_text' => 'Grab Deals',
                'cta_url' => '/black-friday',
            ],
        ];

        foreach ($ads as $ad) {
            Advertisement::create($ad);
        }
    }
}
