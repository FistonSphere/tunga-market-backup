<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    // Fetch data
    public function collection()
    {
        return Product::with(['category', 'brand'])->get();
    }

    // Customize each row
    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->sku,
            $product->category->name ?? '-',
            $product->brand->name ?? '-',
            $product->price,
            $product->stock_quantity,
        ];
    }

    // Column headings
    public function headings(): array
    {
        return [
            'ID',
            'Product Name',
            'SKU',
            'Category',
            'Brand',
            'Price (RWF)',
            'Stock Quantity',
        ];
    }
}
