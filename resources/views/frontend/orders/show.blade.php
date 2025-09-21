@extends('layouts.app')

@section('content')
    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }

            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }

        @keyframes progressAnim {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }

        .animate-slide-in {
            animation: slideIn 0.4s ease-out forwards;
        }

        .animate-fade-out {
            animation: fadeOut 0.6s ease-in forwards;
        }

        .animate-progress {
            animation: progressAnim 3.5s linear forwards;
        }
    </style>

    @php
        $orderNo = $order->items->first()->order_no ?? 'N/A';
    @endphp
    <script>
        // Map of products in this order for quick client-side lookup
        window.orderProducts = {!! json_encode(
            $order->items->map(function ($item) {
                $p = $item->product;
                return [
                    'product_id' => $p ? $p->id : null,
                    'name' => $p ? $p->name : 'Unknown product',
                    'image' => $p && $p->main_image ? asset('storage/' . $p->main_image) : asset('assets/images/no-image.png'),
                    'sku' => $p ? $p->sku : null,
                    'order_item_id' => $item->id,
                ];
            }),
        ) !!};
    </script>

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
                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $badgeClasses }}"
                            style="margin-right: 20px;">
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
                            <button onclick="PrintInvoice({{ $order->id }})"
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
    <!-- Main Content -->
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Left Column - Order Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Order Summary Section -->
                    <div class="card">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-semibold text-primary flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Order Summary
                            </h2>
                            <button onclick="toggleSection('order-summary-content')"
                                class="text-secondary-600 hover:text-accent transition-fast">
                                <svg class="w-5 h-5 transform transition-transform duration-200" id="order-summary-icon"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                        </div>

                        <div id="order-summary-content" class="space-y-4">
                            <div id="order-items-container" class="space-y-4">
                                @foreach ($order->items as $item)
                                    <div
                                        class="flex items-start space-x-4 p-4 border border-border rounded-lg hover:shadow-sm transition-fast">
                                        {{-- Product image --}}
                                        <img src="{{ $item->product->main_image ?? asset('assets/images/no-image.png') }}"
                                            alt="{{ $item->product->name ?? 'Product' }}"
                                            class="w-20 h-20 rounded-lg object-cover flex-shrink-0" loading="lazy">

                                        <div class="flex-1 min-w-0">
                                            {{-- Product name --}}
                                            <h4 class="font-semibold text-primary mb-1">
                                                {{ $item->product->name ?? 'Unnamed Product' }}
                                            </h4>

                                            {{-- SKU (from variant if exists, else product SKU) --}}
                                            <p class="text-sm text-secondary-600 mb-2">
                                                SKU: {{ $item->product->sku ?? 'N/A' }}
                                            </p>

                                            <!-- Info left | Price right -->
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-4 text-sm text-secondary-600">
                                                    <span>Qty:
                                                        <strong class="text-primary">{{ $item->quantity }}</strong>
                                                    </span>
                                                    <span>Unit Price:
                                                        <strong class="text-primary">
                                                            {{ number_format($item->price) }} {{ $order->currency }}
                                                        </strong>
                                                    </span>
                                                </div>
                                                <div class="text-lg font-semibold text-accent">
                                                    {{ number_format($item->quantity * $item->price) }}
                                                    {{ $order->currency }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Order Totals -->
                            <div class="border-t border-border pt-4">
                                <div class="space-y-2">
                                    <div class="flex justify-between text-secondary-600">
                                        <span>Subtotal:</span>
                                        <span id="subtotal">
                                            {{ number_format($subtotal) }} {{ $order->currency }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between text-secondary-600">
                                        <span>Shipping:</span>
                                        <span id="shipping-cost">Free</span>
                                    </div>
                                    <div class="flex justify-between text-secondary-600">
                                        <span>Tax:</span>
                                        <span id="tax-amount"> {{ number_format($tax) }} {{ $order->currency }}</span>
                                    </div>
                                    <div
                                        class="flex justify-between text-lg font-bold text-primary border-t border-border pt-2">
                                        <span>Total:</span>
                                        <span id="final-total">
                                            {{ number_format($finalTotal) }} {{ $order->currency }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Shipping Tracking Section -->
                    <div class="card">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-semibold text-primary flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                </svg>
                                Shipping & Tracking
                            </h2>
                            <button onclick="toggleSection('shipping-content')"
                                class="text-secondary-600 hover:text-accent transition-fast">
                                <svg class="w-5 h-5 transform transition-transform duration-200" id="shipping-icon"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>

                        <div id="shipping-content" class="space-y-6">
                            <!-- Delivery Timeline -->
                            <div>
                                <h3 class="font-semibold text-primary mb-4">Delivery Timeline</h3>
                                <div id="tracking-timeline" class="relative pl-8">
                                    <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-secondary-200"></div>

                                    @foreach ($timeline as $step)
                                        <div class="relative flex items-start space-x-6 pb-8">
                                            <div
                                                class="w-8 h-8 {{ $step['done'] ? 'bg-success' : 'bg-secondary-300' }} rounded-full flex items-center justify-center flex-shrink-0 relative z-10">
                                                @if ($step['done'])
                                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4 class="font-semibold text-primary mb-1">{{ $step['title'] }}</h4>
                                                <p
                                                    class="text-sm {{ $step['done'] ? 'text-success font-medium' : 'text-secondary-400' }} mb-1">
                                                    {{ $step['timestamp'] }}
                                                </p>
                                                <p class="text-sm text-secondary-600">{{ $step['message'] }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Delivery Address -->
                            <div class="bg-surface rounded-lg p-4">
                                <h3 class="font-semibold text-primary mb-3">Delivery Address</h3>
                                <div class="text-secondary-600" id="delivery-address">
                                    <div class="font-medium text-primary">
                                        {{ $order->shippingAddress->first_name }} {{ $order->shippingAddress->last_name }}
                                    </div>
                                    <div>{{ $order->shippingAddress->address_line1 }}</div>
                                    @if ($order->shippingAddress->address_line2)
                                        <div>{{ $order->shippingAddress->address_line2 }}</div>
                                    @endif
                                    <div>{{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }}
                                        {{ $order->shippingAddress->postal_code }}</div>
                                    <div>{{ $order->shippingAddress->country }}</div>
                                    <div>Phone: {{ $order->shippingAddress->phone }}</div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Payment Information Section -->
                    <div class="card">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-semibold text-primary flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                                Payment Information
                            </h2>
                            <button onclick="toggleSection('payment-content')"
                                class="text-secondary-600 hover:text-accent transition-fast">
                                <svg class="w-5 h-5 transform transition-transform duration-200" id="payment-icon"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>

                        <div id="payment-content" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    {{-- Payment Method --}}
                                    <div>
                                        <label class="text-sm text-secondary-600">Payment Method</label>
                                        <div class="flex items-center space-x-3 mt-1">
                                            {{-- Icon (can be dynamic per method if you want) --}}
                                            <svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M21 4H3c-1.1 0-2 .9-2 2v12c0
                                                                                                         1.1.9 2 2 2h18c1.1 0 2-.9
                                                                                                         2-2V6c0-1.1-.9-2-2-2zm0
                                                                                                         12H3V8h18v8z" />
                                            </svg>
                                            <div>
                                                <div class="font-semibold text-primary" id="payment-method-display">
                                                    {{ $order->payment->masked_account ?? 'N/A' }}
                                                </div>
                                                <div class="text-sm text-secondary-600">
                                                    {{ $order->payment->payment_method ?? 'Not Provided' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Transaction ID --}}
                                    <div>
                                        <label class="text-sm text-secondary-600">Transaction ID</label>
                                        <div class="font-medium text-primary" id="transaction-id-display">
                                            {{ $order->payment->transaction_id ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    {{-- Payment Status --}}
                                    <div>
                                        <label class="text-sm text-secondary-600">Payment Status</label>
                                        <div class="flex items-center space-x-2 mt-1">
                                            @php
                                                $status = $order->payment->status ?? 'unpaid';
                                                $statusColors = [
                                                    'paid' => 'bg-success-100 text-success-800',
                                                    'pending' => 'bg-warning-100 text-warning-800',
                                                    'failed' => 'bg-danger-100 text-danger-800',
                                                    'unpaid' => 'bg-secondary-100 text-secondary-800',
                                                ];
                                            @endphp

                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full
                             text-xs font-medium {{ $statusColors[$status] ?? 'bg-secondary-100 text-secondary-800' }}">
                                                @if ($status === 'paid')
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                @elseif($status === 'pending')
                                                    <svg class="w-3 h-3 mr-1 animate-pulse" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <circle cx="12" cy="12" r="10" stroke-width="2" />
                                                    </svg>
                                                @elseif($status === 'failed')
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                @endif
                                                {{ ucfirst($status) }}
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Payment Date --}}
                                    <div>
                                        <label class="text-sm text-secondary-600">Payment Date</label>
                                        <div class="font-medium text-primary" id="payment-date">
                                            {{ $order->payment && $order->payment->paid_at
                                                ? $order->payment->paid_at->format('F j, Y \a\t g:i A')
                                                : 'Not Paid Yet' }}
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Billing Address -->
                            <div class="border-t border-border pt-4">
                                <h3 class="font-semibold text-primary mb-3">Billing Address</h3>
                                <div class="text-secondary-600" id="billing-address">
                                    <div class="font-medium text-primary">{{ $order->shippingAddress->first_name }}
                                        {{ $order->shippingAddress->last_name }}</div>
                                    <div>{{ $order->shippingAddress->address_line1 }}</div>
                                    @if ($order->shippingAddress->address_line2)
                                        <div>{{ $order->shippingAddress->address_line2 }}</div>
                                    @endif
                                    <div>{{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }}
                                        {{ $order->shippingAddress->postal_code }}</div>
                                    <div>{{ $order->shippingAddress->country }}</div>
                                    <div>Phone: {{ $order->shippingAddress->phone }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Documents Section -->
                    <div class="card">
                        <h2 class="text-xl font-semibold text-primary mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Order Documents
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <button onclick="downloadInvoice()"
                                class="flex flex-col items-center p-4 border-2 border-dashed border-border rounded-lg hover:border-accent hover:bg-accent-50 transition-fast group">
                                <svg class="w-8 h-8 text-secondary-400 group-hover:text-accent mb-2" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="font-medium text-primary group-hover:text-accent">Invoice</span>
                                <span class="text-sm text-secondary-600">PDF Download</span>
                            </button>

                            <button onclick="downloadReceipt()"
                                class="flex flex-col items-center p-4 border-2 border-dashed border-border rounded-lg hover:border-accent hover:bg-accent-50 transition-fast group">
                                <svg class="w-8 h-8 text-secondary-400 group-hover:text-accent mb-2" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <span class="font-medium text-primary group-hover:text-accent">Receipt</span>
                                <span class="text-sm text-secondary-600">PDF Download</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Actions & Supplier Info -->
                <div class="space-y-6">
                    <!-- Supplier Information -->
                    <div class="card">
                        <h3 class="text-lg font-semibold text-primary mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-6m-8 0H3m2 0h6M9 7h6m-6 4h6m-6 4h6" />
                            </svg>
                            Supplier Information
                        </h3>

                        <div class="space-y-4">
                            <div class="flex items-start space-x-4">
                                <div
                                    class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-6m-8 0H3m2 0h6M9 7h6m-6 4h6m-6 4h6" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-primary" id="supplier-name-display">Tunga Market</h4>
                                    <p class="text-secondary-600" id="supplier-location-display">Kigali, Rwanda</p>
                                    {{-- <div class="flex items-center mt-2">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-warning fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <span class="text-sm font-medium text-secondary-600 ml-1">4.8 (1,247
                                                reviews)</span>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-secondary-600">Response Rate</span>
                                    <div class="font-semibold text-success">96%</div>
                                </div>
                                <div>
                                    <span class="text-secondary-600">Response Time</span>
                                    <div class="font-semibold text-primary">
                                        < 2 hours</div>
                                    </div>
                                </div>

                                <div class="flex space-x-2">
                                    <button onclick="contactSupplier()"
                                        class="flex-1 btn-secondary text-sm flex items-center justify-center group">
                                        <svg class="w-4 h-4 mr-2 group-hover:text-white transition-colors duration-200"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        <span
                                            class="group-hover:text-white font-semibold transition-colors duration-200">Contact</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="card">
                            <h3 class="text-lg font-semibold text-primary mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Quick Actions
                            </h3>

                            <div class="space-y-3">
                                <button onclick="reorderItems()"
                                    class="w-full btn-primary flex items-center justify-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    <span>Reorder Items</span>
                                </button>

                                <button onclick="reportIssue({{ $item->product->id }})"
                                    class="w-full text-left px-4 py-3 border border-warning text-warning hover:bg-warning-50 rounded-lg transition-fast flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <span>Report Issue</span>
                                </button>

                                <button onclick="writeReview()"
                                    class="w-full text-left px-4 py-3 border border-border text-secondary-600 hover:bg-surface hover:text-primary rounded-lg transition-fast flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                    <span>Write Review</span>
                                </button>
                            </div>
                        </div>

                        <!-- Customer Support -->
                        <div class="card">
                            <h3 class="text-lg font-semibold text-primary mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Need Help?
                            </h3>

                            <div class="space-y-3">
                                <button onclick="contactSupport()"
                                    class="w-full btn-secondary flex items-center justify-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <span>Live Chat Support</span>
                                </button>

                                <a href="help_center.html"
                                    class="w-full text-center px-4 py-3 border border-border text-secondary-600 hover:bg-surface hover:text-primary rounded-lg transition-fast flex items-center justify-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Help Center</span>
                                </a>

                                <div class="text-center text-sm text-secondary-600">
                                    <p>Order support available 24/7</p>
                                    <p class="text-accent font-medium">Response within 2 hours</p>
                                </div>
                            </div>
                        </div>

                        <!-- Related Orders -->
                        <div class="card">
                            <h3 class="text-lg font-semibold text-primary mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Related Orders
                            </h3>

                            <div class="space-y-3">
                                <a href="order_detail_view.html?order=AM2025-456789"
                                    class="block p-3 border border-border rounded-lg hover:border-accent hover:bg-accent-50 transition-fast">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="font-semibold text-primary">#AM2025-456789</div>
                                            <div class="text-sm text-secondary-600">Jan 20, 2025</div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-semibold text-accent">$1,245.75</div>
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                                Shipped
                                            </span>
                                        </div>
                                    </div>
                                </a>

                                <a href="order_detail_view.html?order=AM2025-543210"
                                    class="block p-3 border border-border rounded-lg hover:border-accent hover:bg-accent-50 transition-fast">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="font-semibold text-primary">#AM2025-543210</div>
                                            <div class="text-sm text-secondary-600">Jan 10, 2025</div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-semibold text-accent">$428.90</div>
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-success-100 text-success-800">
                                                Delivered
                                            </span>
                                        </div>
                                    </div>
                                </a>

                                <a href="order_tracking_center.html"
                                    class="block text-center text-accent hover:text-accent-600 font-semibold text-sm p-3 border-2 border-dashed border-accent rounded-lg transition-fast">
                                    View All Orders
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- Payment Warning Modal -->
    <div id="payment-warning-modal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div
            class="bg-white rounded-2xl shadow-modal w-full max-w-md mx-auto transform transition-all duration-300 relative p-8">

            <!-- Close Button -->
            <button onclick="closePaymentWarningModal()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-fast p-1 rounded-full hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Warning Icon -->
            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856C19.07 19 20 18.07 20 16.938V7.062C20 5.93 19.07 5 17.938 5H6.062C4.93 5 4 5.93 4 7.062v9.876C4 18.07 4.93 19 6.062 19z" />
                </svg>
            </div>

            <!-- Message -->
            <h2 class="text-2xl font-bold text-primary mb-3 text-center">Payment Pending</h2>
            <p class="text-body text-secondary-600 mb-6 leading-relaxed text-center">
                You cannot generate a receipt until this order is paid.
            </p>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <button onclick="closePaymentWarningModal()"
                    class="w-full bg-yellow-500 text-white py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Okay, Got It
                </button>
            </div>
        </div>
    </div>

    <!-- Contact Supplier Modal -->
    <div id="contact-supplier-modal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div
            class="bg-white rounded-2xl shadow-modal w-full max-w-md mx-auto transform transition-all duration-300 relative p-8">

            <!-- Close Button -->
            <button onclick="closeContactSupplierModal()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-fast p-1 rounded-full hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Chat Icon -->
            <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
            </div>

            <!-- Title -->
            <h2 class="text-2xl font-bold text-primary mb-3 text-center">Contact Supplier</h2>
            <p class="text-body text-secondary-600 mb-6 leading-relaxed text-center">
                Choose how you’d like to communicate with the supplier.
            </p>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <!-- WhatsApp -->
                <button onclick="contactViaWhatsApp()"
                    class="w-full bg-green-500 text-white py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M20.52 3.48A11.93 11.93 0 0012 0C5.37 0 0 5.37 0 12c0 2.12.55 4.17 1.6 5.97L0 24l6.21-1.58A11.94 11.94 0 0012 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22c-1.82 0-3.6-.49-5.16-1.42l-.37-.22-3.69.94.99-3.59-.24-.38A9.93 9.93 0 012 12c0-5.51 4.49-10 10-10s10 4.49 10 10-4.49 10-10 10zm5.12-7.65c-.28-.14-1.66-.82-1.92-.91-.26-.1-.45-.14-.64.14-.19.28-.73.91-.9 1.1-.17.19-.34.21-.62.07-.28-.14-1.19-.44-2.26-1.4-.84-.75-1.41-1.68-1.57-1.96-.16-.28-.02-.43.12-.57.12-.12.28-.31.42-.47.14-.16.19-.28.28-.47.09-.19.05-.35-.02-.49-.07-.14-.64-1.54-.88-2.11-.23-.56-.47-.49-.64-.5-.16-.01-.35-.01-.54-.01s-.49.07-.75.35c-.26.28-.99.97-.99 2.36 0 1.39 1.02 2.73 1.16 2.92.14.19 2.01 3.07 4.87 4.3.68.29 1.21.46 1.62.59.68.22 1.29.19 1.77.12.54-.08 1.66-.68 1.89-1.33.23-.65.23-1.2.16-1.33-.07-.13-.26-.21-.54-.35z" />
                    </svg>
                    WhatsApp
                </button>

                <!-- Contact Us Page -->
                <button onclick="redirectToContactPage()"
                    class="w-full bg-primary text-white py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Contact Us Page
                </button>
            </div>
        </div>
    </div>

    <!-- Reorder Modal -->
    <div id="reorder-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div
            class="bg-white rounded-2xl shadow-modal w-full max-w-md mx-auto transform transition-all duration-300 relative p-8">

            <!-- Close -->
            <button onclick="closeReorderModal()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-fast p-1 rounded-full hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Icon -->
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </div>

            <!-- Title -->
            <h2 class="text-2xl font-bold text-primary mb-3 text-center">Reorder Items?</h2>
            <p class="text-body text-secondary-600 mb-6 leading-relaxed text-center">
                Do you want to reorder all items from this order? They will be added back to your cart.
            </p>

            <!-- Actions -->
            <div class="space-y-3">
                <button onclick="confirmReorder()"
                    class="w-full bg-primary text-white py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Yes, Reorder
                </button>
                <button onclick="closeReorderModal()"
                    class="text-secondary-500 hover:text-accent transition-fast text-body-sm font-medium w-full">
                    Cancel
                </button>
            </div>
        </div>
    </div>
    <!-- Report Issue Modal (Reorder-style visual) -->
    <div id="report-issue-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden" style="z-index: 9999999;">
        <div
            class="bg-white rounded-2xl shadow-modal w-full max-w-md mx-auto transform transition-all duration-300 relative p-8">

            <!-- Close -->
            <button onclick="closeReportIssue()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-fast p-1 rounded-full hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Icon -->
            <div class="w-16 h-16 bg-amber-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18.364 5.636l-1.414 1.414M5.636 18.364l1.414-1.414M2 12h2M20 12h2M12 2v2M12 20v2" />
                </svg>
            </div>

            <!-- Product Info -->
            @foreach ($order->items as $item)
                <div id="report-issue-product" class="flex items-center space-x-4 mb-4">
                    <img src="{{ $item->product->main_image ?? asset('assets/images/no-image.png') }}"
                        alt="{{$item->product->name}}" class="w-16 h-16 rounded border object-cover">
                    <div>
                        <div class="font-semibold text-primary">{{$item->product->name}}</div>
                        <div class="text-sm text-secondary-600">SKU: {{$item->product->sku}}</div>
                    </div>
                </div>
            @endforeach
            <!-- Title -->
            <h2 class="text-2xl font-bold text-primary mb-3 text-center">Report an Issue</h2>
            <p class="text-body text-secondary-600 mb-6 leading-relaxed text-center">
                Tell us what went wrong with this product, our support team will review and contact you.
            </p>

            <textarea id="report-issue-message" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-amber-300"
                rows="4" placeholder="Describe the issue (be as detailed as possible)..." style="outline:none; resize:none;"></textarea>

            <!-- Actions -->
            <div class="space-y-3 mt-6">
                <button onclick="submitReportIssue()"
                    class="w-full bg-accent-600 text-white py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Submit Issue
                </button>
                <button onclick="closeReportIssue()"
                    class="text-secondary-500 hover:text-accent transition-fast text-body-sm font-medium w-full">
                    Cancel
                </button>
            </div>
        </div>
    </div>
@endsection



<script>
    function toggleSection(sectionId) {
        const content = document.getElementById(sectionId);
        const icon = document.getElementById(sectionId.replace('-content', '-icon'));

        if (!content || !icon) return;

        if (content.style.display === 'none' || content.style.display === '') {
            content.style.display = 'block';
            icon.style.transform = 'rotate(0deg)';
        } else {
            content.style.display = 'none';
            icon.style.transform = 'rotate(-90deg)';
        }
    }

    function downloadInvoice() {
        const orderId = "{{ $order->id }}";
        window.location.href = `/orders/${orderId}/invoice`;
    }

    function downloadReceipt() {
        const orderId = "{{ $order->id }}";
        const orderStatus = "{{ $order->payment->status }}";

        if (orderStatus.toLowerCase() === 'paid') {
            window.location.href = `/orders/${orderId}/receipt`;
        } else {
            openPaymentWarningModal();
        }
    }

    function openPaymentWarningModal() {
        document.getElementById("payment-warning-modal").classList.remove("hidden");
    }

    function closePaymentWarningModal() {
        document.getElementById("payment-warning-modal").classList.add("hidden");
    }

    function PrintInvoice(orderId) {
        window.open(`/orders/${orderId}/invoice?autoPrint=1`, '_blank');
    }

    function contactSupplier() {
        document.getElementById("contact-supplier-modal").classList.remove("hidden");
    }

    function closeContactSupplierModal() {
        document.getElementById("contact-supplier-modal").classList.add("hidden");
    }

    function contactViaWhatsApp() {
        const orderId = "{{ $orderNo }}";
        const supplierName = "Tunga Market";

        // Template message
        const message = encodeURIComponent(
            `Hello ${supplierName},\n\nI am contacting you regarding my order (NO: ${orderId}). Could you please assist me with more details?`
        );

        window.open(`https://wa.me/250787444019?text=${message}`, "_blank");
    }

    function redirectToContactPage() {
        window.location.href = "/contact";
    }

    function reorderItems() {
        document.getElementById("reorder-modal").classList.remove("hidden");
    }

    function closeReorderModal() {
        document.getElementById("reorder-modal").classList.add("hidden");
    }

    function confirmReorder() {
        const orderId = "{{ $order->id }}";

        fetch(`/orders/${orderId}/reorder`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                }
            })
            .then(response => response.json())
            .then(data => {
                closeReorderModal();
                if (data.success) {
                    showNotify("success", "Items have been added to your cart successfully!");
                } else {
                    showNotify("error", data.message || "Something went wrong, please try again.");
                }
            })
            .catch(() => {
                closeReorderModal();
                showNotify("error", "Network error, please try again.");
            });
    }

    // Toast Notification
    function showNotify(type, message) {
        const styles = {
            success: {
                bg: "bg-green-500",
                icon: "✔️",
                title: "Success"
            },
            error: {
                bg: "bg-red-500",
                icon: "⚠️",
                title: "Error"
            }
        };

        let container = document.getElementById("toast-container");
        if (!container) {
            container = document.createElement("div");
            container.id = "toast-container";
            container.className = "fixed top-5 right-5 space-y-3 z-50 flex flex-col";
            document.body.appendChild(container);
        }

        // Toast wrapper
        const notify = document.createElement("div");
        notify.className =
            `relative flex items-start space-x-3 ${styles[type].bg} text-white px-4 py-3 rounded-lg shadow-lg w-80 animate-slide-in hover:scale-105 transition transform duration-200`;

        // Icon
        const icon = document.createElement("span");
        icon.className = "text-2xl";
        icon.innerText = styles[type].icon;

        // Content
        const content = document.createElement("div");
        content.className = "flex-1";
        content.innerHTML = `
            <div class="font-semibold">${styles[type].title}</div>
            <div class="text-sm opacity-90">${message}</div>
        `;

        // Progress bar
        const progress = document.createElement("div");
        progress.className =
            "absolute bottom-0 left-0 h-1 bg-white opacity-70 rounded-bl-lg rounded-br-lg animate-progress";
        progress.style.width = "100%";

        // Append
        notify.appendChild(icon);
        notify.appendChild(content);
        notify.appendChild(progress);
        container.appendChild(notify);

        // Auto-remove
        setTimeout(() => {
            notify.classList.add("animate-fade-out");
            setTimeout(() => notify.remove(), 500);
        }, 4000);
    }


    const reportIssueUrl = "{{ route('orders.reportIssue', $order->id) }}";

    let __currentReportProductId = null;

    function reportIssue(productId) {
        __currentReportProductId = prod?.product_id || productId;
        document.getElementById('report-issue-message').value = '';

        // show modal
        document.getElementById('report-issue-modal').classList.remove('hidden');
    }

    function closeReportIssue() {
        document.getElementById('report-issue-modal').classList.add('hidden');
        __currentReportProductId = null;
    }

    async function submitReportIssue() {
        const message = document.getElementById('report-issue-message').value.trim();
        if (!message || message.length < 5) {
            showNotify('error', 'Please provide more details about the issue (min 5 chars).');
            return;
        }

        if (!__currentReportProductId) {
            showNotify('error', 'No product selected.');
            return;
        }

        try {
            const res = await fetch(reportIssueUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: __currentReportProductId,
                    message: message
                })
            });

            const data = await res.json().catch(() => null);

            if (!res.ok) {
                const errMsg = data?.message || 'Failed to submit. Please try again.';
                showNotify('error', errMsg);
                return;
            }

            if (data.success) {
                closeReportIssue();
                showNotify('success', data.message || 'Issue submitted — we will contact you shortly.');
            } else {
                showNotify('error', data.message || 'Failed to report issue.');
            }
        } catch (err) {
            console.error(err);
            showNotify('error', 'Network error. Please try again.');
        }
    }

    
    if (typeof showNotify !== 'function') {
        function showNotify(type, message) {
            const colors = {
                success: "bg-green-500",
                error: "bg-red-500"
            };
            let container = document.getElementById("toast-container");
            if (!container) {
                container = document.createElement("div");
                container.id = "toast-container";
                container.className = "fixed top-5 right-5 space-y-2 z-50";
                document.body.appendChild(container);
            }
            const notify = document.createElement("div");
            notify.className = `${colors[type] || colors.error} text-white px-4 py-3 rounded shadow-lg w-80`;
            notify.innerHTML = `<div class="font-semibold">${message}</div>`;
            container.appendChild(notify);
            setTimeout(() => {
                notify.remove();
            }, 3500);
        }
    }



</script>
