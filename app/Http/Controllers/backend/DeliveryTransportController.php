<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\DeliveryAssignment;
use App\Models\DeliveryTransport;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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

 public function assignDelivery(Request $request)
{
    $validated = $request->validate([
        'order_id' => 'required|exists:orders,id',
        'delivery_transport_id' => 'required|exists:delivery_transports,id',
        'departure_location' => 'nullable|string|max:255',
        'destination' => 'nullable|string|max:255',
        'status' => 'required|in:pending,dispatched,in_transit,arrived',
        'notes' => 'nullable|string',
    ]);

    DeliveryAssignment::create($validated);

    return back()->with('success', 'Delivery assigned successfully!');
}

public function storeTransport(Request $request)
{
    $validated = $request->validate([
        'driver_name' => 'required|string|max:255',
        'driver_phone' => 'required|string|max:50',
        'transport_type' => 'required|in:car,bike,bicycle,bus,plane',
        'vehicle_plate' => 'nullable|string|max:255',
    ]);

    $validated['assigned_by'] = auth()->id();

    DeliveryTransport::create($validated);

    return back()->with('success', 'New transport added successfully!');
}


public function update(Request $request, DeliveryAssignment $delivery)
{
    $validated = $request->validate([
        'departure_location' => 'nullable|string|max:255',
        'destination' => 'nullable|string|max:255',
        'status' => 'required|in:pending,dispatched,in_transit,arrived',
        'notes' => 'nullable|string',
    ]);

    // Update delivery
    $delivery->update($validated);

    // === Get transport & driver details ===
    $transport = $delivery->transport;
    if (!$transport) {
        return back()->with('warning', 'Delivery updated, but no driver assigned to notify.');
    }

    $driverName = $transport->driver_name;
    $driverPhone = $this->formatMtnPhone($transport->driver_phone);
    $transportType = ucfirst($transport->transport_type ?? 'N/A');

    // === Prepare message ===
    $smsMessage = "Hello {$driverName},\n\n"
        . "Your delivery assignment has been updated.\n\n"
        . "🛻 Vehicle: {$transportType} ({$transport->vehicle_plate})\n"
        . "📍 Departure: " . ($validated['departure_location'] ?? $delivery->departure_location ?? 'N/A') . "\n"
        . "🎯 Destination: " . ($validated['destination'] ?? $delivery->destination ?? 'N/A') . "\n"
        . "🚦 Status: " . ucfirst($validated['status']) . "\n"
        . (!empty($validated['notes']) ? "📝 Notes: {$validated['notes']}\n\n" : "\n")
        . "Please check your delivery dashboard for more details.";

    // === Send SMS via Mista.io ===
    $apiToken = config('services.mista.api_token');
    $senderId = config('services.mista.sender_id');

    try {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiToken,
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ])->post('https://api.mista.io/sms', [
            'to' => $driverPhone,
            'from' => $senderId,
            'message' => $smsMessage,
        ]);

        Log::info("📩 Delivery update SMS sent to {$driverPhone}. Response: " . $response->body());
    } catch (\Exception $e) {
        Log::error("❌ Failed to send SMS to driver {$driverName}: " . $e->getMessage());
    }

    return back()->with('success', 'Delivery details updated and driver notified via SMS!');
}

/**
 * Format MTN phone number to international format (2507xxxxxxx)
 */
private function formatMtnPhone($phone)
{
    $digits = preg_replace('/\D/', '', $phone); // remove non-numeric characters

    // Handle local MTN formats like 07xxxxxxx or 7xxxxxxx
    if (str_starts_with($digits, '07')) {
        $digits = '250' . substr($digits, 1);
    } elseif (str_starts_with($digits, '7')) {
        $digits = '250' . $digits;
    } elseif (!str_starts_with($digits, '2507')) {
        // fallback if already has 250 but missing 7 (rare)
        $digits = '2507' . substr($digits, -8);
    }

    return $digits;
}



public function destroy(DeliveryAssignment $delivery)
{
    $delivery->delete();
    return back()->with('success', 'Delivery assignment removed successfully!');
}

}
