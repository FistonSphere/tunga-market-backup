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
        'sku',
        'stock_quantity',
        'main_image',
        'gallery',
        'features',
        'specifications',
        'shipping_info',
        'tags',
        'status'
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
    public function attributes()
    {
        // return $this->hasMany(ProductAttribute::class);
    }
}
