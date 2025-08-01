<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Physical', 'Digital', 'Service', 'Bundle'];

        foreach ($types as $type) {
            ProductType::firstOrCreate(
                ['slug' => Str::slug($type)],  // Check by unique slug
                ['name' => $type]
            );
        }
    }
}
