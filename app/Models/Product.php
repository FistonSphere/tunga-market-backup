<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'short_description',
        'long_description',
        'price',
        'discount_price',
        'currency',
        'sku',
        'stock_quantity',
        'main_image',
        'gallery',
        'features',
        'specifications',
        'shipping_info',
        'tags',
        'status',
        'brand_id',
        'product_type_id',
        'unit_id',
        'tax_class_id',
    ];

    protected $casts = [
        'gallery' => 'array',
        'features' => 'array',
        'specifications' => 'array',
        'shipping_info' => 'array',
        'tags' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(ProductTag::class, 'product_tag');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function taxClass()
    {
        return $this->belongsTo(TaxClass::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function attributes()
    {
        // return $this->hasMany(ProductAttribute::class);
    }
    public function carts()
{
    return $this->hasMany(Cart::class);
}

}
