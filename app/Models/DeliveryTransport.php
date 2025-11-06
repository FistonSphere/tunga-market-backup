<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTransport extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'assigned_by',
        'driver_name',
        'driver_phone',
        'transport_type',
        'vehicle_plate',
        'departure_location',
        'destination',
        'dispatched_at',
        'arrived_at',
        'status',
        'notes',
    ];

    protected $dates = ['dispatched_at', 'arrived_at'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
