<!-- resources/views/orders/index.blade.php -->
@extends('admin.layouts.header')

@section('content')
    <div class="orders-container p-6 bg-gray-50 min-h-screen">

        <!-- HEADER -->
        <div class="flex flex-wrap justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="bi bi-bag-check-fill text-blue-600"></i> Orders Management
            </h1>

            <div class="flex gap-3">
                <input type="text" id="searchOrder" placeholder="Search by invoice or customer..."
                    class="px-3 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none w-64">
                <select id="statusFilter"
                    class="px-3 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>

        <!-- ORDERS LIST -->
        <div class="space-y-6">
            @forelse($orders as $order)
                <div
                    class="order-card bg-white rounded-2xl shadow-sm hover:shadow-md transition-all p-5 border border-gray-100">

                    <!-- Top Section -->
                    <div class="flex justify-between flex-wrap items-center border-b pb-3">
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-semibold text-gray-500">Invoice:</span>
                            <span class="text-blue-600 font-bold">{{ $order->invoice_number }}</span>
                        </div>

                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @if($order->status === 'completed') bg-green-100 text-green-700
                            @elseif($order->status === 'pending') bg-yellow-100 text-yellow-700
                            @elseif($order->status === 'cancelled') bg-red-100 text-red-700
                            @else bg-gray-100 text-gray-700 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <!-- Order Details -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                        <!-- Products -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-600 mb-2">Products</h3>
                            <div class="space-y-3">
                                @foreach($order->items as $item)
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $item->product->image ?? asset('images/no-image.png') }}"
                                            class="w-14 h-14 rounded-lg object-cover border">
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $item->product->name }}</p>
                                            <p class="text-sm text-gray-500">Qty: {{ $item->quantity }} ×
                                                {{ number_format($item->price, 2) }} {{ $order->currency }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Customer Info -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-600 mb-2">Customer</h3>
                            <p class="text-gray-800 font-medium">{{ $order->user->first_name ?? '' }}
                                {{ $order->user->last_name ?? '' }}</p>
                            <p class="text-sm text-gray-500">{{ $order->user->email ?? 'No email' }}</p>
                            <p class="text-sm text-gray-500">{{ $order->shippingAddress->phone ?? 'No phone' }}</p>
                        </div>

                        <!-- Payment & Total -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-600 mb-2">Payment & Total</h3>
                            <p class="text-gray-800 font-medium">
                                {{ ucfirst($order->payment_method) ?? 'N/A' }}
                            </p>
                            <p class="text-lg font-bold text-green-600 mt-1">
                                {{ number_format($order->total, 2) }} {{ $order->currency }}
                            </p>
                            <p class="text-xs text-gray-400">Created: {{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="flex justify-end mt-4 gap-3">
                        <button onclick="viewOrderDetails('{{ $order->id }}')"
                            class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition-all">
                            View Details
                        </button>
                        <button
                            class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 text-sm font-semibold hover:bg-gray-200 transition-all">
                            Contact Buyer
                        </button>
                    </div>

                </div>
            @empty
                <div class="text-center py-10 text-gray-400">
                    <i class="bi bi-inbox text-4xl"></i>
                    <p class="mt-2">No orders found yet.</p>
                </div>
            @endforelse
        </div>

        <!-- PAGINATION -->
        <div class="mt-8">
            {{ $orders->links() }}
        </div>

    </div>

    <!-- Optional Modal Placeholder -->
    <div id="orderDetailsModal"></div>

@endsection