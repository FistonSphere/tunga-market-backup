<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'company',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'postal_code',
        'country',
        'phone',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullAddressAttribute()
{
    $parts = [
        $this->address_line1,
        $this->address_line2,
        $this->city,
        $this->state,
        $this->postal_code,
        $this->country,
    ];

    // Join only non-empty fields
    $filtered = array_filter($parts, fn($value) => !empty($value));

    return implode(', ', $filtered);
}

}
