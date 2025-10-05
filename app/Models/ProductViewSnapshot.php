<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductViewSnapshot extends Model
{
    protected $fillable = [
        'product_id',
        'views_count',
        'recorded_at',
    ];

    public $dates = ['recorded_at', 'created_at', 'updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
