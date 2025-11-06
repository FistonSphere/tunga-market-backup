<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'delivery_transport_id',
        'departure_location',
        'destination',
        'dispatched_at',
        'arrived_at',
        'status',
        'notes',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function transport()
    {
        return $this->belongsTo(DeliveryTransport::class, 'delivery_transport_id');
    }
}
