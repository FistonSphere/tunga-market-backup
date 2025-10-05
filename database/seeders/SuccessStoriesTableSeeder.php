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
                'position' => 'CEO',
                'company' => 'TechStart Solutions',
                'testimonial' => 'Tunga Market transformed our sourcing process. We\'ve reduced costs by 35% while improving quality through their verified supplier network.',
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=800',
                'metric_one' => '↗ 35% cost reduction',
                'metric_two' => '2.5M+ revenue growth',
            ],
            [
                'name' => 'Marcus Rodriguez',
                'position' => 'Founder',
                'company' => 'Global Textiles',
                'testimonial' => 'The community features helped us connect with buyers we never would have found. Our export volume tripled in just 8 months.',
                'image' => 'https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg',
                'metric_one' => '↗ 300% export growth',
                'metric_two' => '45+ new markets',
            ],
            [
                'name' => 'Priya Patel',
                'position' => 'Director',
                'company' => 'EcoHome Innovations',
                'testimonial' => 'From startup to scale-up in 18 months. The AI-powered recommendations helped us discover profitable niches we hadn\'t considered.',
                'image' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?q=80&w=800',
                'metric_one' => '↗ 450% revenue growth',
                'metric_two' => '12 new product lines',
            ],
            [
                'name' => 'John Kamanzi',
                'position' => 'Managing Director',
                'company' => 'Rwanda Coffee Exporters',
                'testimonial' => 'We reached international clients faster than ever before. The visibility from Tunga Market has boosted our brand recognition globally.',
                'image' => 'https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?q=80&w=800',
                'metric_one' => '↗ 60% export growth',
                'metric_two' => '20+ new clients',
            ],
            [
                'name' => 'Aisha Mbabazi',
                'position' => 'Founder',
                'company' => 'Handmade Kigali',
                'testimonial' => 'Thanks to Tunga Market, our handmade crafts are now available to customers across Africa. We’ve doubled our sales in just 6 months!',
                'image' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?q=80&w=800',
                'metric_one' => '↗ 200% sales increase',
                'metric_two' => 'Across 5 African countries',
            ],
        ];


        foreach ($stories as $story) {
            SuccessStory::create($story);
        }
    }
    }
}
