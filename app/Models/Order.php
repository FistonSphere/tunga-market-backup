<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'currency',
        'status',
        'shipping_address_id',
        'payment_method',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function shippingAddress()
    {
        return $this->belongsTo(ShippingAddress::class);
    }

    public function payment()
{
    return $this->hasOne(Payment::class);
}
public function generateInvoiceNumber()
    {
        if ($this->invoice_number) {
            return $this->invoice_number;
        }

        // Ensure we have an ID (order already exists)
        if (!$this->id) {
            // if you might call this before saving the order, you could save first:
            $this->save();
        }

        $base = 'INV-' . date('Y') . '-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
        $candidate = $base;
        $suffix = 0;

        while (self::where('invoice_number', $candidate)->exists()) {
            $suffix++;
            $candidate = $base . '-' . str_pad($suffix, 3, '0', STR_PAD_LEFT);
        }

        $this->invoice_number = $candidate;
        // Persist to DB
        $this->save();

        return $this->invoice_number;
    }

}
