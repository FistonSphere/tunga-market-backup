<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

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
        'gallery'         => 'array',
        'features'        => 'array',
        'specifications'  => 'array',
        'shipping_info'   => 'array',
        'tags'            => 'array',
    ];

    // Append computed attributes for Blade access
    protected $appends = ['average_rating', 'reviews_count_custom', 'rating_breakdown'];

    // Relationships
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

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function units(){
        return $this->belongsTo(Unit::class);
    }

    // Computed attributes

    // Total verified reviews
    public function getReviewsCountCustomAttribute()
    {
        return $this->reviews()->where('verified', true)->count();
    }

    // Average rating from verified reviews
    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->where('verified', true)->avg('rating') ?? 0, 1);
    }

    // Rating breakdown (percentage for each star 1–5)
    public function getRatingBreakdownAttribute()
    {
        $reviews = $this->reviews()->where('verified', true)->get();
        $total   = max($reviews->count(), 1); // prevent division by zero

        return collect(range(5, 1))->mapWithKeys(function ($star) use ($reviews, $total) {
            $count = $reviews->where('rating', $star)->count();
            return [$star => round(($count / $total) * 100)];
        });
    }

    // Optional: transform reviews for frontend
    public function getTransformedReviewsAttribute()
    {
        return $this->reviews()->where('verified', true)->with('user')->latest()->get()->map(function ($review) {
            return (object)[
                'user' => (object)[
                    'name'   => $review->user->first_name ?? 'Anonymous',
                    'avatar' => $review->user->profile_picture ?? asset('assets/images/avatar.png'),
                ],
                'rating'        => $review->rating,
                'comment'       => $review->comment,
                'created_at'    => $review->created_at,
                'verified'      => true,
                'helpful_count' => $review->helpful_count ?? 0,
            ];
        })->values();
    }

    public function flashDeals()
{
    return $this->hasMany(FlashDeal::class, 'product_id');
}

}
