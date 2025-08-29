<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
   protected $fillable = [
       'name',
       'company',
       'email',
       'phone',
       'quantity',
       'target_price',
       'message',
       'product_id'
   ];

    public function product()
    {
         return $this->belongsTo(Product::class);
    }
}
