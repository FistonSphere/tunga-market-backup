<?php

namespace Database\Seeders;

use App\Models\SuccessStory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuccessStoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    {
        SuccessStory::truncate();

        $stories = [
            [
                'name' => 'Sarah Chen',
                'role' => 'CEO',
                'company' => 'TechStart Solutions',
                'testimonial' => 'Tunga Market transformed our sourcing process. We\'ve reduced costs by 35% while improving quality through their verified supplier network.',
                'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=800',
                'highlight_1' => '↗ 35% cost reduction',
                'highlight_2' => '2.5M+ revenue growth',
            ],
            [
                'name' => 'Marcus Rodriguez',
                'role' => 'Founder',
                'company' => 'Global Textiles',
                'testimonial' => 'The community features helped us connect with buyers we never would have found. Our export volume tripled in just 8 months.',
                'photo' => 'https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg',
                'highlight_1' => '↗ 300% export growth',
                'highlight_2' => '45+ new markets',
            ],
            [
                'name' => 'Priya Patel',
                'role' => 'Director',
                'company' => 'EcoHome Innovations',
                'testimonial' => 'From startup to scale-up in 18 months. The AI-powered recommendations helped us discover profitable niches we hadn\'t considered.',
                'photo' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?q=80&w=800',
                'highlight_1' => '↗ 450% revenue growth',
                'highlight_2' => '12 new product lines',
            ],
            [
                'name' => 'John Kamanzi',
                'role' => 'Managing Director',
                'company' => 'Rwanda Coffee Exporters',
                'testimonial' => 'We reached international clients faster than ever before. The visibility from Tunga Market has boosted our brand recognition globally.',
                'photo' => 'https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?q=80&w=800',
                'highlight_1' => '↗ 60% export growth',
                'highlight_2' => '20+ new clients',
            ],
            [
                'name' => 'Aisha Mbabazi',
                'role' => 'Founder',
                'company' => 'Handmade Kigali',
                'testimonial' => 'Thanks to Tunga Market, our handmade crafts are now available to customers across Africa. We’ve doubled our sales in just 6 months!',
                'photo' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?q=80&w=800',
                'highlight_1' => '↗ 200% sales increase',
                'highlight_2' => 'Across 5 African countries',
            ],
        ];


        foreach ($stories as $story) {
            SuccessStory::create($story);
        }
    }
    }
}
