<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTransport extends Model
{
    use HasFactory;

    protected $fillable = [
        'assigned_by',
        'driver_name',
        'driver_phone',
        'transport_type',
        'vehicle_plate',
        'notes',
    ];

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function assignments()
    {
        return $this->hasMany(DeliveryAssignment::class);
    }

    public function getDisplayNameAttribute()
    {
        return "{$this->driver_name} ({$this->transport_type})";
    }
}
