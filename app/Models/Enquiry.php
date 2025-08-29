<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
   protected $fillable = [
       'name',
       'email',
       'phone',
       'message',
       'product_id',
   ];

    public function product()
    {
         return $this->belongsTo(Product::class);
    }
}
