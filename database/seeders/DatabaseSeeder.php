<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            BrandSeeder::class,
            ProductTypeSeeder::class,
            TagSeeder::class,
            TaxClassSeeder::class,     // ✅ New
            UnitSeeder::class,         // ✅ New
            ProductSeeder::class,
            OrdersTableSeeder::class, // ✅ New
            PaymentsTableSeeder::class,
            FaqsTableSeeder::class,
            FlashDealsTableSeeder::class, // ✅ New
            SuccessStoriesTableSeeder::class, // ✅ New
            TeamMemberSeeder::class, // ✅ New


        ]);
    }
}
