<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

   class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'specifications',
        'price',
        'stock_quantity',
    ];

    protected $casts = [
        'specifications' => 'array',
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
