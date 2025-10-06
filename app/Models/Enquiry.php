<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
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
       'product_id',
       'ticket',
   ];

    public function product()
    {
         return $this->belongsTo(Product::class);
    }

    protected static function booted()
    {
        static::creating(function ($enquiry) {
            $enquiry->ticket = self::generateTicket();
        });
    }

    /**
     * Generate a unique ticket ID
     */
    public static function generateTicket()
    {
        do {
            $ticket = 'TKT-' . strtoupper(Str::random(8));
        } while (self::where('ticket', $ticket)->exists());

        return $ticket;
    }
}
