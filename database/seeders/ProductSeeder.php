<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductType;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Tag;
use Illuminate\Support\Str;

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

        // Insert products and get their instances
        $product1 = Product::create([
            'name' => 'Samsung Galaxy S21',
            'slug' => Str::slug('Samsung Galaxy S21'),
            'description' => 'Latest Samsung flagship smartphone with high-end specs.',
            'price' => 799.99,
            'stock_quantity' => 100,
            'main_image' => 'products/samsung-s21.jpg',
            'gallery' => json_encode(['products/samsung-s21-1.jpg', 'products/samsung-s21-2.jpg']),
            'features' => json_encode(['AMOLED Display', '5G', 'Triple Camera']),
            'specifications' => json_encode(['RAM' => '8GB', 'Storage' => '128GB', 'Battery' => '4000mAh']),
            'category_id' => $electronics->id,
            'brand_id' => $samsung->id,
            'product_type_id' => $physical->id,
        ]);

        $product2 = Product::create([
            'name' => 'Nike Air Max 270',
            'slug' => Str::slug('Nike Air Max 270'),
            'description' => 'Comfortable and stylish sneakers from Nike.',
            'price' => 150.00,
            'stock_quantity' => 50,
            'main_image' => 'products/nike-airmax270.jpg',
            'gallery' => json_encode(['products/nike-airmax270-1.jpg']),
            'features' => json_encode(['Air Sole Unit', 'Breathable Material']),
            'specifications' => json_encode(['Size' => '42', 'Color' => 'Black', 'Material' => 'Mesh']),
            'category_id' => $fashion->id,
            'brand_id' => $nike->id,
            'product_type_id' => $physical->id,
        ]);

        $product3 = Product::create([
            'name' => 'Sony WH-1000XM5 Headphones',
            'slug' => Str::slug('Sony WH-1000XM5 Headphones'),
            'description' => 'Industry-leading noise cancellation headphones.',
            'price' => 349.00,
            'stock_quantity' => 30,
            'main_image' => 'products/sony-headphones.jpg',
            'gallery' => json_encode([]),
            'features' => json_encode(['Noise Cancelling', 'Bluetooth 5.2']),
            'specifications' => json_encode(['Battery' => '30 Hours', 'Weight' => '250g']),
            'category_id' => $electronics->id,
            'brand_id' => $sony->id,
            'product_type_id' => $physical->id,
        ]);

        $product4 = Product::create([
            'name' => 'Digital Photography eBook',
            'slug' => Str::slug('Digital Photography eBook'),
            'description' => 'Learn the art of digital photography.',
            'price' => 19.99,
            'stock_quantity' => 999,
            'main_image' => 'products/photography-ebook.jpg',
            'gallery' => json_encode([]),
            'features' => json_encode(['PDF Format', 'Instant Download']),
            'specifications' => json_encode(['Pages' => '120', 'Format' => 'PDF']),
            'category_id' => $home->id,
            'brand_id' => null,
            'product_type_id' => $digital->id,
        ]);

        $product5 = Product::create([
            'name' => 'Non-stick Frying Pan',
            'slug' => Str::slug('Non-stick Frying Pan'),
            'description' => 'Perfect for everyday cooking.',
            'price' => 25.99,
            'stock_quantity' => 75,
            'main_image' => 'products/frying-pan.jpg',
            'gallery' => json_encode([]),
            'features' => json_encode(['Non-stick Coating', 'Dishwasher Safe']),
            'specifications' => json_encode(['Size' => '28cm', 'Material' => 'Aluminum']),
            'category_id' => $home->id,
            'brand_id' => null,
            'product_type_id' => $physical->id,
        ]);

        // Fetch tags
        $tagSmartphone = ProductTag::where('slug', 'smartphone')->first();
        $tagSneakers = ProductTag::where('slug', 'sneakers')->first();
        $tagHeadphones = ProductTag::where('slug', 'headphones')->first();
        $tagEbook = ProductTag::where('slug', 'ebook')->first();
        $tagKitchenware = ProductTag::where('slug', 'kitchenware')->first();

        // Attach tags to products (many-to-many)
        $product1->tags()->attach($tagSmartphone->id);
        $product2->tags()->attach($tagSneakers->id);
        $product3->tags()->attach($tagHeadphones->id);
        $product4->tags()->attach($tagEbook->id);
        $product5->tags()->attach($tagKitchenware->id);
    }
}
