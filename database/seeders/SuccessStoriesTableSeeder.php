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
                'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=2787&auto=format&fit=crop',
                'testimonial' => 'Tunga Market transformed our sourcing process. We\'ve reduced costs by 35% while improving quality through their verified supplier network.',
                'highlight_1' => '↗ 35% cost reduction',
                'highlight_2' => '2.5M+ revenue growth',
            ],
            [
                'name' => 'Marcus Rodriguez',
                'role' => 'Founder',
                'company' => 'Global Textiles',
                'photo' => 'https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                'testimonial' => 'The community features helped us connect with buyers we never would have found. Our export volume tripled in just 8 months.',
                'highlight_1' => '↗ 300% export growth',
                'highlight_2' => '45+ new markets',
            ],
            [
                'name' => 'Priya Patel',
                'role' => 'Director',
                'company' => 'EcoHome Innovations',
                'photo' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?q=80&w=2787&auto=format&fit=crop',
                'testimonial' => 'From startup to scale-up in 18 months. The AI-powered recommendations helped us discover profitable niches we hadn\'t considered.',
                'highlight_1' => '↗ 450% revenue',
                'highlight_2' => '12 new product lines',
            ],
        ];

        foreach ($stories as $story) {
            SuccessStory::create($story);
        }
    }
    }
}