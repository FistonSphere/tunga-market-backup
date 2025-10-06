<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        TeamMember::create([
            'name' => 'Sarah Chen',
            'position' => 'Chief Executive Officer',
            'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=400&auto=format&fit=crop',
            'bio' => 'Former VP at Alibaba with 15+ years in global trade. Sarah’s vision drives our platform innovation.',
            'instagram' => 'https://instagram.com/sarahchen',
            'facebook' => null,
            'twitter' => 'https://twitter.com/sarahchen',
        ]);
    }
}
