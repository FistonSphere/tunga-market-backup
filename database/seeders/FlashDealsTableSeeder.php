<?php

namespace Database\Seeders;

use App\Models\FlashDeal;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class FlashDealsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        // Ensure you already have some products in DB
        $productIds = Product::pluck('id')->take(5); // just grab first 5 products

        if ($productIds->isEmpty()) {
            $this->command->warn('⚠️ No products found. Please seed products first.');
            return;
        }

        $now = Carbon::now();

        $samples = [
            [
                'product_id' => $productIds[0],
                'discount_percent' => 70,
                'flash_price' => 2999, // Rwf example
                'start_time' => $now->copy()->subHours(1),   // started 1h ago
                'end_time' => $now->copy()->addDays(2),      // ends in 2 days
                'is_active' => true,
            ],
            [
                'product_id' => $productIds[1],
                'discount_percent' => 45,
                'flash_price' => 5499,
                'start_time' => $now->copy()->subHours(3),   // started 3h ago
                'end_time' => $now->copy()->addHours(20),    // ends in 20h
                'is_active' => true,
            ],
            [
                'product_id' => $productIds[2],
                'discount_percent' => 60,
                'flash_price' => 3999,
                'start_time' => $now->copy()->addHours(6),   // will start later today
                'end_time' => $now->copy()->addDays(1),      // ends tomorrow
                'is_active' => true,
            ],
            [
                'product_id' => $productIds[3],
                'discount_percent' => 55,
                'flash_price' => 2249,
                'start_time' => $now->copy()->addDays(1),    // starts tomorrow
                'end_time' => $now->copy()->addDays(3),      // ends in 3 days
                'is_active' => true,
            ],
        ];

        foreach ($samples as $deal) {
            FlashDeal::create($deal);
        }

        $this->command->info('✅ Flash deals seeded successfully!');
    }
}
