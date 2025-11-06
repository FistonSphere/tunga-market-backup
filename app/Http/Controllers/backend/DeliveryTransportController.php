<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\DeliveryAssignment;
use App\Models\DeliveryTransport;
use App\Models\Order;
use Illuminate\Http\Request;

class DeliveryTransportController extends Controller
{
    public function assign(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'driver_name' => 'required|string|max:255',
            'driver_phone' => 'required|string|max:20',
            'transport_type' => 'required|in:car,bike,bicycle',
            'departure_location' => 'nullable|string|max:255',
            'destination' => 'nullable|string|max:255',
        ]);

        $validated['assigned_by'] = auth()->id();
        $validated['status'] = 'dispatched';
        $validated['dispatched_at'] = now();

        DeliveryTransport::create($validated);

        return back()->with('success', 'Delivery assigned successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:dispatched,in_transit,arrived,failed'
        ]);

        $transport = DeliveryTransport::findOrFail($id);
        $transport->update($validated);

        if ($validated['status'] === 'arrived') {
            $transport->update(['arrived_at' => now()]);
        }

        return back()->with('success', 'Delivery status updated.');
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'order_id' => 'required|exists:orders,id',
        'driver_name' => 'required|string|max:255',
        'driver_phone' => 'required|string|max:50',
        'transport_type' => 'required|in:car,bike,bicycle,bus,plane',
        'vehicle_plate' => 'nullable|string|max:255',
        'departure_location' => 'nullable|string|max:255',
        'destination' => 'nullable|string|max:255',
        'status' => 'required|in:pending,dispatched,in_transit,arrived',
        'notes' => 'nullable|string',
    ]);

    // Step 1: Reuse or create transport record
    $transport = DeliveryTransport::firstOrCreate(
        [
            'driver_name' => $validated['driver_name'],
            'driver_phone' => $validated['driver_phone'],
        ],
        [
            'assigned_by' => auth()->id(),
            'transport_type' => $validated['transport_type'],
            'vehicle_plate' => $validated['vehicle_plate'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]
    );

    // Step 2: Create the delivery assignment
    $assignment = DeliveryAssignment::create([
        'order_id' => $validated['order_id'],
        'delivery_transport_id' => $transport->id,
        'departure_location' => $validated['departure_location'] ?? 'Warehouse HQ',
        'destination' => $validated['destination'] ?? 'Customer address',
        'status' => $validated['status'],
        'dispatched_at' => now(),
        'notes' => $validated['notes'] ?? null,
    ]);

    // Step 3: Update order status
    $order = Order::find($validated['order_id']);
    if ($order && $order->status === 'pending') {
        $order->status = 'processing';
        $order->save();
    }

    return back()->with('success', 'Delivery assigned successfully!');
}


}
