<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\{Product, Category, Brand, ProductType, Unit, TaxClass, ProductTag, ProductAttribute};

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $electronics = Category::where('name', 'Electronics')->first();
        $fashion = Category::where('name', 'Fashion')->first();
        $home = Category::where('name', 'Home & Kitchen')->first();

        $samsung = Brand::where('name', 'Samsung')->first();
        $nike = Brand::where('name', 'Nike')->first();
        $sony = Brand::where('name', 'Sony')->first();

        $physical = ProductType::where('name', 'Physical')->first();
        $digital = ProductType::where('name', 'Digital')->first();

        $unitPiece = Unit::where('name', 'Piece')->first();
        $unitFile = Unit::where('name', 'File')->first();

        $taxStandard = TaxClass::where('name', 'Standard')->first();

        $products = [
            [
                'name' => 'Samsung Galaxy S21',
                'sku' => 'SGS21-005',
                'short_description' => 'Latest Samsung flagship smartphone with high-end specs.',
                'long_description' => 'The Samsung Galaxy S21 features a 6.2-inch display, powerful Exynos processor, and an advanced triple-camera system. It supports 5G and has a long-lasting battery life.',
                'price' => 799.99,
                'discount_price' => 749.99,
                'stock_quantity' => 100,
                'main_image' => 'products/samsung-s21.jpg',
                'gallery' => ['products/samsung-s21-1.jpg', 'products/samsung-s21-2.jpg'],
                'features' => ['AMOLED Display', '5G', 'Triple Camera'],
                'specifications' => ['RAM' => '8GB', 'Storage' => '128GB', 'Battery' => '4000mAh'],
                'category' => $electronics,
                'brand' => $samsung,
                'type' => $physical,
                'unit' => $unitPiece,
                'tag_slug' => 'smartphone',
            ],
            [
                'name' => 'Nike Air Max 270',
                'sku' => 'SGS21-004',
                'short_description' => 'Comfortable and stylish sneakers from Nike.',
                'long_description' => 'Nike Air Max 270 offers superior comfort and breathability...',
                'price' => 150.00,
                'stock_quantity' => 50,
                'main_image' => 'products/nike-airmax270.jpg',
                'gallery' => ['products/nike-airmax270-1.jpg'],
                'features' => ['Air Sole Unit', 'Breathable Material'],
                'specifications' => ['Size' => '42', 'Color' => 'Black', 'Material' => 'Mesh'],
                'category' => $fashion,
                'brand' => $nike,
                'type' => $physical,
                'unit' => $unitPiece,
                'tag_slug' => 'sneakers',
                'attributes' => [
                    ['name' => 'Color', 'value' => 'Black'],
                    ['name' => 'Size', 'value' => '42']
                ]
            ],
            [
                'name' => 'Sony WH-1000XM5 Headphones',
                'sku' => 'SGS21-003',
                'short_description' => 'Industry-leading noise cancellation headphones.',
                'long_description' => 'Sony WH-1000XM5 headphones deliver exceptional sound...',
                'price' => 349.00,
                'stock_quantity' => 30,
                'main_image' => 'products/sony-headphones.jpg',
                'gallery' => [],
                'features' => ['Noise Cancelling', 'Bluetooth 5.2'],
                'specifications' => ['Battery' => '30 Hours', 'Weight' => '250g'],
                'category' => $electronics,
                'brand' => $sony,
                'type' => $physical,
                'unit' => $unitPiece,
                'tag_slug' => 'headphones',
            ],
            [
                'name' => 'Digital Photography eBook',
                'sku' => 'SGS21-002',
                'short_description' => 'Learn the art of digital photography.',
                'long_description' => 'This eBook covers the fundamentals of digital photography...',
                'price' => 19.99,
                'stock_quantity' => 999,
                'main_image' => 'products/photography-ebook.jpg',
                'gallery' => [],
                'features' => ['PDF Format', 'Instant Download'],
                'specifications' => ['Pages' => '120', 'Format' => 'PDF'],
                'category' => $home,
                'brand' => null,
                'type' => $digital,
                'unit' => $unitFile,
                'tag_slug' => 'ebook',
            ],
            [
                'name' => 'Non-stick Frying Pan',
                'sku' => 'SGS21-001',
                'short_description' => 'Perfect for everyday cooking.',
                'long_description' => 'Durable non-stick frying pan suitable for all cooktops...',
                'price' => 25.99,
                'stock_quantity' => 75,
                'main_image' => 'products/frying-pan.jpg',
                'gallery' => [],
                'features' => ['Non-stick Coating', 'Dishwasher Safe'],
                'specifications' => ['Size' => '28cm', 'Material' => 'Aluminum'],
                'category' => $home,
                'brand' => null,
                'type' => $physical,
                'unit' => $unitPiece,
                'tag_slug' => 'kitchenware',
            ],
        ];

        foreach ($products as $productData) {
            $slug = Str::slug($productData['name']);

            $product = Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $productData['name'],
                    'sku' => $productData['sku'],
                    'short_description' => $productData['short_description'],
                    'long_description' => $productData['long_description'],
                    'price' => $productData['price'],
                    'discount_price' => $productData['discount_price'] ?? null,
                    'stock_quantity' => $productData['stock_quantity'],
                    'main_image' => $productData['main_image'],
                    'gallery' => json_encode($productData['gallery']),
                    'features' => json_encode($productData['features']),
                    'specifications' => json_encode($productData['specifications']),
                    'category_id' => $productData['category']->id,
                    'brand_id' => $productData['brand']->id ?? null,
                    'product_type_id' => $productData['type']->id,
                    'unit_id' => $productData['unit']->id,
                    'tax_class_id' => $taxStandard->id,
                ]
            );

            // Attach tag
            if (!empty($productData['tag_slug'])) {
                $tag = ProductTag::where('slug', $productData['tag_slug'])->first();
                if ($tag) {
                    $product->tags()->syncWithoutDetaching([$tag->id]);
                }
            }

            // Add attributes if defined
            if (!empty($productData['attributes'])) {
                foreach ($productData['attributes'] as $attr) {
                    ProductAttribute::updateOrCreate(
                        ['product_id' => $product->id, 'name' => $attr['name']],
                        ['value' => $attr['value']]
                    );
                }
            }
        }
    }
}

