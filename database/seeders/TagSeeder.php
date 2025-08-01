<?php

namespace Database\Seeders;

use App\Models\ProductTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        $tags = ['New Arrival', 'Best Seller', 'Trending', 'Limited Edition', 'Discounted'];

        foreach ($tags as $tag) {
            ProductTag::create([
                'name' => $tag,
                'slug' => Str::slug($tag),
            ]);
        }
    }
}
