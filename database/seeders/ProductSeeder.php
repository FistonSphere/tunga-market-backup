<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductType;
use App\Models\ProductTag;
use App\Models\Unit;
use App\Models\TaxClass;
use App\Models\ProductAttribute;

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

        // Product 1
        $product1 = Product::create([
            'name' => 'Samsung Galaxy S21',
            'slug' => Str::slug('Samsung Galaxy S21'),
            'sku' => 'SGS21-005',
            'short_description' => 'Latest Samsung flagship smartphone with high-end specs.',
            'long_description' => 'The Samsung Galaxy S21 features a 6.2-inch display, powerful Exynos processor, and an advanced triple-camera system. It supports 5G and has a long-lasting battery life.',
            'price' => 799.99,
            'discount_price' => 749.99,
            'stock_quantity' => 100,
            'main_image' => 'products/samsung-s21.jpg',
            'gallery' => json_encode(['products/samsung-s21-1.jpg', 'products/samsung-s21-2.jpg']),
            'features' => json_encode(['AMOLED Display', '5G', 'Triple Camera']),
            'specifications' => json_encode(['RAM' => '8GB', 'Storage' => '128GB', 'Battery' => '4000mAh']),
            'category_id' => $electronics->id,
            'brand_id' => $samsung->id,
            'product_type_id' => $physical->id,
            'unit_id' => $unitPiece->id,
            'tax_class_id' => $taxStandard->id,
        ]);

        // Product 2
        $product2 = Product::create([
            'name' => 'Nike Air Max 270',
            'slug' => Str::slug('Nike Air Max 270'),
            'sku' => 'SGS21-004',
            'short_description' => 'Comfortable and stylish sneakers from Nike.',
            'long_description' => 'Nike Air Max 270 offers superior comfort and breathability, designed with a large Air unit and lightweight materials, perfect for everyday wear.',
            'price' => 150.00,
            'stock_quantity' => 50,
            'main_image' => 'products/nike-airmax270.jpg',
            'gallery' => json_encode(['products/nike-airmax270-1.jpg']),
            'features' => json_encode(['Air Sole Unit', 'Breathable Material']),
            'specifications' => json_encode(['Size' => '42', 'Color' => 'Black', 'Material' => 'Mesh']),
            'category_id' => $fashion->id,
            'brand_id' => $nike->id,
            'product_type_id' => $physical->id,
            'unit_id' => $unitPiece->id,
            'tax_class_id' => $taxStandard->id,
        ]);

        // Product 3
        $product3 = Product::create([
            'name' => 'Sony WH-1000XM5 Headphones',
            'slug' => Str::slug('Sony WH-1000XM5 Headphones'),
            'sku' => 'SGS21-003',
            'short_description' => 'Industry-leading noise cancellation headphones.',
            'long_description' => 'Sony WH-1000XM5 headphones deliver exceptional sound quality with industry-leading noise cancellation and Bluetooth 5.2 connectivity for seamless wireless listening.',
            'price' => 349.00,
            'stock_quantity' => 30,
            'main_image' => 'products/sony-headphones.jpg',
            'gallery' => json_encode([]),
            'features' => json_encode(['Noise Cancelling', 'Bluetooth 5.2']),
            'specifications' => json_encode(['Battery' => '30 Hours', 'Weight' => '250g']),
            'category_id' => $electronics->id,
            'brand_id' => $sony->id,
            'product_type_id' => $physical->id,
            'unit_id' => $unitPiece->id,
            'tax_class_id' => $taxStandard->id,
        ]);

        // Product 4
        $product4 = Product::create([
            'name' => 'Digital Photography eBook',
            'slug' => Str::slug('Digital Photography eBook'),
            'sku' => 'SGS21-002',
            'short_description' => 'Learn the art of digital photography.',
            'long_description' => 'This eBook covers the fundamentals of digital photography, from camera settings to composition techniques, perfect for beginners and enthusiasts.',
            'price' => 19.99,
            'stock_quantity' => 999,
            'main_image' => 'products/photography-ebook.jpg',
            'gallery' => json_encode([]),
            'features' => json_encode(['PDF Format', 'Instant Download']),
            'specifications' => json_encode(['Pages' => '120', 'Format' => 'PDF']),
            'category_id' => $home->id,
            'brand_id' => null,
            'product_type_id' => $digital->id,
            'unit_id' => $unitFile->id,
            'tax_class_id' => $taxStandard->id,
        ]);

        // Product 5
        $product5 = Product::create([
            'name' => 'Non-stick Frying Pan',
            'slug' => Str::slug('Non-stick Frying Pan'),
            'sku' => 'SGS21-001',
            'short_description' => 'Perfect for everyday cooking.',
            'long_description' => 'Durable non-stick frying pan suitable for all cooktops. Easy to clean and dishwasher safe, making your cooking experience hassle-free.',
            'price' => 25.99,
            'stock_quantity' => 75,
            'main_image' => 'products/frying-pan.jpg',
            'gallery' => json_encode([]),
            'features' => json_encode(['Non-stick Coating', 'Dishwasher Safe']),
            'specifications' => json_encode(['Size' => '28cm', 'Material' => 'Aluminum']),
            'category_id' => $home->id,
            'brand_id' => null,
            'product_type_id' => $physical->id,
            'unit_id' => $unitPiece->id,
            'tax_class_id' => $taxStandard->id,
        ]);

        // Product Tags
        $tagSmartphone = ProductTag::where('slug', 'smartphone')->first();
        $tagSneakers = ProductTag::where('slug', 'sneakers')->first();
        $tagHeadphones = ProductTag::where('slug', 'headphones')->first();
        $tagEbook = ProductTag::where('slug', 'ebook')->first();
        $tagKitchenware = ProductTag::where('slug', 'kitchenware')->first();

        $product1->tags()->attach($tagSmartphone->id);
        $product2->tags()->attach($tagSneakers->id);
        $product3->tags()->attach($tagHeadphones->id);
        $product4->tags()->attach($tagEbook->id);
        $product5->tags()->attach($tagKitchenware->id);

        // Optional product attributes example
        ProductAttribute::create([
            'product_id' => $product2->id,
            'name' => 'Color',
            'value' => 'Black'
        ]);
        ProductAttribute::create([
            'product_id' => $product2->id,
            'name' => 'Size',
            'value' => '42'
        ]);
    }
}
