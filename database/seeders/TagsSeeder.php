<?php

namespace Database\Seeders;

use App\Models\ProductTag;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'New Arrival',
            'Best Seller',
            'Discount',
            'Limited Edition',
            'Popular',
        ];

        foreach ($tags as $tag) {
            ProductTag::create([
                'name' => $tag,
                'slug' => Str::slug($tag),
            ]);
        }
    }
}
