<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxClass extends Model
{
    protected $fillable = ['name', 'rate', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
