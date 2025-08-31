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
protected $appends = ['average_rating', 'reviews_count_custom', 'rating_breakdown'];

    // Average rating accessor
    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->where('verified', true)->avg('rating') ?? 0, 1);
    }

    // Reviews count accessor
    public function getReviewsCountCustomAttribute()
    {
        return $this->reviews()->where('verified', true)->count();
    }

    // Rating breakdown accessor
    public function getRatingBreakdownAttribute()
    {
        $reviews = $this->reviews()->where('verified', true)->get();

        return collect(range(1, 5))->mapWithKeys(function ($star) use ($reviews) {
            return [$star => $reviews->where('rating', $star)->count()];
        });
    }
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
