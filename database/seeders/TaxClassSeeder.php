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
        $taxes = [
            ['name' => 'Standard VAT', 'rate' => 18],
            ['name' => 'Reduced VAT', 'rate' => 8],
            ['name' => 'Zero VAT', 'rate' => 0],
        ];

        foreach ($taxes as $tax) {
            TaxClass::create([
                'name' => $tax['name'],
                'rate' => $tax['rate'],
            ]);
        }
    }
}
