<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ad;

class AdSeeder extends Seeder
{
    public function run()
    {
        Ad::create([
            'title' => 'Fashion Week 2025',
            'subtitle' => 'Trending styles from global designers',
            'media_url' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=800&auto=format&fit=crop',
            'badge' => 'NEW ARRIVALS',
            'cta_text' => 'Watch Collection →',
            'extra_info' => '👗 1000+ New Items',
            'type' => 'video',
            'link' => '#',
            'order' => 1,
        ]);

        Ad::create([
            'title' => 'Global Beauty',
            'subtitle' => 'Premium skincare & luxury cosmetics',
            'media_url' => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?q=80&w=100&auto=format&fit=crop',
            'badge' => 'BEAUTY WEEK',
            'cta_text' => 'Shop Collection',
            'extra_info' => '💖 45% OFF',
            'type' => 'image',
            'link' => '#',
            'order' => 2,
        ]);

        Ad::create([
            'title' => 'Electronics Mega Sale',
            'subtitle' => 'Top gadgets at unbeatable prices',
            'media_url' => 'https://images.unsplash.com/photo-1510552776732-41a0d2d3a539?q=80&w=800&auto=format&fit=crop',
            'badge' => 'HOT DEALS',
            'cta_text' => 'Shop Now',
            'extra_info' => '📦 Free Shipping',
            'type' => 'image',
            'link' => '#',
            'order' => 3,
        ]);
    }
}
