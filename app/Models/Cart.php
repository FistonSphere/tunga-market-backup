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
     * Enforce flash deal rules (quantity = 1, price = flash_price)
     */
    protected static function booted()
    {
        static::creating(function ($cart) {
            $cart->applyFlashDealRules();
        });

        static::updating(function ($cart) {
            $cart->applyFlashDealRules();
        });
    }

    /**
     * Helper method to enforce flash deal restrictions
     */
    protected function applyFlashDealRules()
    {
        if ($this->deal_id && $this->flashDeal) {
            // Force quantity = 1
            $this->quantity = 1;

            // Ensure cart price matches flash deal price
            if (isset($this->flashDeal->flash_price)) {
                $this->price = $this->flashDeal->flash_price;
            }
        } else {
            // Fallback to product price if not a flash deal
            if ($this->product) {
                $this->price = $this->product->price;
            }
        }
    }
}
