<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'product_variant_id',
        'price',
        'order_no',
    ];

     protected static function boot()
    {
        parent::boot();

        static::creating(function ($orderItem) {
            // Only generate if not manually set
            if (empty($orderItem->order_no)) {
                do {
                    $code = 'ORD-' . strtoupper(Str::random(6));
                } while (self::where('order_no', $code)->exists());

                $orderItem->order_no = $code;
            }
        });
    }

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
}
