<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Insert sample orders
        DB::table('orders')->insert([
            [
                'id' => 1,
                'user_id' => 4,
                'total' => 150.00,
                'currency' => 'Rwf',
                'status' => 'pending',
                'shipping_address_id' => 1,
                'payment_method' => 'cash',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'user_id' => 4,
                'total' => 95.50,
                'currency' => 'Rwf',
                'status' => 'completed',
                'shipping_address_id' => 2,
                'payment_method' => 'credit_card',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Insert related order items
        DB::table('order_items')->insert([
            // Order 1 (Order No: ORD-20250910-1)
            [
                'order_no' => 'ORD-20250910-1',
                'order_id' => 1,
                'product_id' => 2001,
                'quantity' => 2,
                'price' => 50.00,
                'product_variant_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'order_no' => 'ORD-20250910-1',
                'order_id' => 1,
                'product_id' => 2005,
                'quantity' => 1,
                'price' => 50.00,
                'product_variant_id' => 301,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Order 2 (Order No: ORD-20250910-2)
            [
                'order_no' => 'ORD-20250910-2',
                'order_id' => 2,
                'product_id' => 2010,
                'quantity' => 1,
                'price' => 45.50,
                'product_variant_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'order_no' => 'ORD-20250910-2',
                'order_id' => 2,
                'product_id' => 2020,
                'quantity' => 1,
                'price' => 50.00,
                'product_variant_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
