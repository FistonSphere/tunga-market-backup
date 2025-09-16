@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-4">Order Details</h2>

        <div class="bg-white shadow rounded p-4 mb-6">
            @php
                $orderNo = $order->items->first()->order_no ?? 'N/A';
            @endphp
            <p><strong>Order #:</strong> {{ $orderNo }}</p>
            <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
            <p><strong>Total:</strong> {{ number_format($order->total, 2) }} {{ $order->currency }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Supplier:</strong>
                Tunga Market
            </p>
        </div>

        <h3 class="text-lg font-semibold mb-2">Items</h3>
        <ul class="divide-y">
            @foreach ($order->items as $item)
                <li class="py-2">
                    {{ $item->product->name ?? 'Unknown Product' }} x {{ $item->quantity }}
                    - {{ number_format($item->price, 2) }} {{ $order->currency }}
                </li>
            @endforeach
        </ul>
    </div>
@endsection
