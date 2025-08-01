<?php

namespace Database\Seeders;

use App\Models\TaxClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $taxClasses = [
            ['name' => 'Standard', 'rate' => 0.15, 'description' => 'Standard tax rate'],
            ['name' => 'Reduced', 'rate' => 0.07, 'description' => 'Reduced tax rate'],
            ['name' => 'Zero', 'rate' => 0.00, 'description' => 'Zero tax rate'],
        ];

        foreach ($taxClasses as $class) {
            TaxClass::firstOrCreate(
                ['name' => $class['name']],  // Use 'name' as unique key
                ['rate' => $class['rate'], 'description' => $class['description']]
            );
        }
    }
}
