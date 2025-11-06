<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\DeliveryTransport;
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
}
