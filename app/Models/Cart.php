<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'deal_id',
        'currency',
        'product_variant_id',
        'shipping_fee',
        'coupon_code',
    ];

    protected $dates = ['deleted_at'];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function flashDeal()
    {
        return $this->belongsTo(FlashDeal::class, 'deal_id');
    }

    /**
     * Force quantity = 1 if the cart item is from a flash deal
     */
    protected static function booted()
    {
        static::creating(function ($cart) {
            if ($cart->deal_id) {
                $cart->quantity = 1;
            }
        });

        static::updating(function ($cart) {
            if ($cart->deal_id) {
                $cart->quantity = 1;
            }
        });
    }
}
