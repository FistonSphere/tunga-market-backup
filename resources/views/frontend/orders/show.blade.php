@extends('layouts.app')

@section('content')
    @php
        $orderNo = $order->items->first()->order_no ?? 'N/A';
    @endphp
    <!-- Breadcrumb Navigation -->
    <section class="bg-surface py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="homepage.html" class="text-secondary-600 hover:text-primary transition-fast">Home</a>
                <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <a href="{{ route('order.tracking') }}" class="text-secondary-600 hover:text-primary transition-fast">Order
                    Tracking</a>
                <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-primary font-semibold" id="breadcrumb-order-number">Order #{{ $orderNo }}</span>
            </nav>
        </div>
    </section>

    <!-- Order Header -->
    <section class="py-8 bg-gradient-to-r from-primary-50 to-accent-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-card p-6 md:p-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6">
                    <div class="mb-4 lg:mb-0">
                        <div class="flex items-center space-x-4 mb-2">
                            <h1 class="text-2xl md:text-3xl font-bold text-primary" id="header-order-number">Order
                                #{{ $orderNo }}</h1>
                            <button onclick="copyOrderNumber()"
                                class="text-secondary-400 hover:text-accent transition-fast p-1" title="Copy Order Number">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 text-secondary-600">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4M3 12h18M7 12l-2 5h14l-2-5" />
                                </svg>
                                <span>Ordered on <span id="header-order-date"
                                        class="font-semibold">{{ $order->created_at->format('M d, Y') }}</span></span>
                            </div>
                            <div class="flex items-center space-x-2 mt-2 sm:mt-0" style="margin-left: 20px;">

                                <span>Total: <span id="header-order-total"
                                        class="font-bold text-accent text-lg">{{ number_format($order->items->first()->price * $order->items->first()->quantity) }}
                                        Rwf</span></span>
                            </div>
                        </div>
                    </div>
                    @php
                        $status = $order->status;

                        $badgeClasses = match ($status) {
                            'Delivered' => 'bg-success-100 text-success-800',
                            'Processing' => 'bg-warning-100 text-warning-800',
                            'Canceled' => 'bg-error-100 text-error-800',
                            default => 'bg-gray-100 text-gray-800',
                        };

                        $iconPath = match ($status) {
                            'Delivered' => 'M5 13l4 4L19 7',
                            'Processing' => 'M12 8v4l3 3 M12 2a10 10 0 100 20 10 10 0 000-20z',
                            'Canceled' => 'M6 18L18 6M6 6l12 12',
                            default => 'M12 4v16m8-8H4',
                        };
                    @endphp


                    <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-3 sm:space-y-0 sm:space-x-4">
                        <span id="header-status-badge"
                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $badgeClasses }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $iconPath }}" />
                            </svg>
                            {{ $status }}
                        </span>

                        <div class="flex space-x-2">
                            <button onclick="downloadInvoice()" class="btn-secondary flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>Invoice</span>
                            </button>
                            <button onclick="printOrder()"
                                class="text-secondary-600 hover:text-primary p-2 border border-border rounded-lg transition-fast">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-4">Order Details</h2>

        <div class="bg-white shadow rounded p-4 mb-6">

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
