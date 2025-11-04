@extends('layouts.app')

@section('content')

    <style>
        @keyframes scale-in {
            from {
                transform: scale(0.9);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animate-scale-in {
            animation: scale-in 0.3s ease-out;
        }
    </style>



    <!-- Order Confirmation Hero -->
    <section class="bg-gradient-to-br from-success-50 to-accent-50 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="w-20 h-20 bg-success rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h1 class="text-4xl font-bold text-primary mb-4">Thank You for Your Order!</h1>
            <p class="text-xl text-secondary-600 mb-8">
                Your order <strong class="text-primary">#{{ $order->id ?? $order->order_number }}</strong>
                has been successfully placed and is being processed.
            </p>

            <!-- Order Summary Card -->
            <div class="card max-w-2xl mx-auto text-left shadow-lg transition-all hover:shadow-xl">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-semibold text-primary mb-4">Order Details</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Order Number:</span>
                                <span class="font-semibold text-primary">#{{ $order->id ?? $order->order_number }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Order Date:</span>
                                <span class="font-semibold">{{ $order->created_at->format('M d, Y - h:i A') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Total Amount:</span>
                                <span class="font-semibold text-accent text-lg">
                                    {{ number_format($order->total) }} {{ $order->currency }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Payment Method:</span>
                                <span class="font-semibold">
                                    {{ $order->payment_method ?? ($order->payment->payment_method ?? 'Cash on Delivery') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="font-semibold text-primary mb-4">Delivery Information</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Estimated Delivery:</span>
                                <span class="font-semibold text-success">
                                    {{ $order->created_at->addMinutes(30)->format('h:i A') }}
                                    –
                                    {{ $order->created_at->addHours(24)->format('h:i A, M d, Y') }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Delivery Window:</span>
                                <span class="font-semibold">30 min – 24 hrs</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Shipping Method:</span>
                                <span class="font-semibold">Standard Express</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Shipping To:</span>
                                <span class="font-semibold text-right">
                                    {{ $order->shippingAddress->first_name }} {{ $order->shippingAddress->last_name }}<br>
                                    {{ $order->shippingAddress->address_line1 }},
                                    {{ $order->shippingAddress->city }}<br>
                                    {{ $order->shippingAddress->country }}
                                </span>
                            </div>
                        </div>

                        <!-- ✅ Download invoice using backend route -->
                        <button class="btn-primary w-full mt-4 flex items-center justify-center gap-2"
                            onclick="downloadInvoice()">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Download Invoice
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Order Items -->
    <section class="py-12 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-primary mb-8">Order Items</h2>

            @if ($order->items && $order->items->count() > 0)
                <div class="space-y-4">
                    @foreach ($order->items as $item)
                        @php
                            $product = $item->product;
                            $variant = $item->variant;
                            $brand = $product->brand->name ?? 'Unknown Brand';
                            $currency = 'Rwf';
                            $unitPrice = $item->price;
                            $totalPrice = $unitPrice * $item->quantity;
                            $status = ucfirst($order->status ?? 'Processing');
                        @endphp

                        <div class="card hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center space-x-4">
                                <!-- Product Image -->
                                <img src="{{ $product->main_image ?? asset('assets/images/no-image.png') }}"
                                    alt="{{ $product->name }}" class="w-20 h-20 rounded-lg object-cover border border-gray-200"
                                    loading="lazy" />

                                <!-- Product Details -->
                                <div class="flex-1">
                                    <h3 class="font-semibold text-primary text-lg">{{ $product->name }}</h3>

                                    <p class="text-secondary-600 mb-2">
                                        Brand: <span class="font-medium">{{ $brand }}</span>
                                    </p>

                                    @if ($variant)
                                        <p class="text-secondary-600 text-sm mb-1">
                                            Variant: {{ $variant->name ?? $variant->sku }}
                                        </p>
                                    @endif

                                    <div class="flex flex-wrap items-center gap-4 text-body-sm">
                                        <span class="text-secondary-600">Qty: {{ $item->quantity }}</span>
                                        <span class="text-secondary-600">
                                            Unit Price: {{ number_format($unitPrice) }} {{ $currency }}
                                        </span>
                                        <span class="font-semibold text-accent">
                                            {{ number_format($totalPrice) }} {{ $currency }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Order Item Status + Action -->
                                <div class="text-right">
                                    @php
                                        $statusColors = [
                                            'Processing' => 'bg-yellow-100 text-yellow-700',
                                            'Delivered' => 'bg-green-100 text-green-700',
                                            'Canceled' => 'bg-red-100 text-red-700',
                                        ];
                                        $badgeClass = $statusColors[$status] ?? 'bg-yellow-100 text-yellow-700';
                                    @endphp

                                    <div class="{{ $badgeClass }} px-3 py-1 rounded-full text-sm font-semibold mb-2 capitalize">
                                        {{ $status }}
                                    </div>

                                    <button class="text-accent hover:text-accent-600 text-sm font-semibold transition-all"
                                        onclick="showTrackingRedirect('{{ $order->invoice_number }}')">
                                        Track This Item
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-secondary-600 py-8">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m2 0a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v4a2 2 0 002 2zm-2 4h10a2 2 0 012 2v2a2 2 0 01-2 2H7a2 2 0 01-2-2v-2a2 2 0 012-2z" />
                    </svg>
                    <p>No items found in this order.</p>
                </div>
            @endif
        </div>
    </section>




    <!-- Feedback & Review Section -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-primary mb-4">Share Your Experience</h2>
                <p class="text-lg text-secondary-600">
                    Help other buyers by sharing your feedback on products and suppliers
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Product Reviews -->
                <div class="card">
                    <h3 class="text-xl font-semibold text-primary mb-6">Rate Your Products</h3>
                    <div class="space-y-6">
                        <!-- Product 1 Review -->
                        <div class="border border-secondary-200 rounded-lg p-4">
                            <div class="flex items-center space-x-3 mb-4">
                                <img src="https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?q=80&w=2679&auto=format&fit=crop"
                                    alt="Wireless Earbuds Pro" class="w-12 h-12 rounded-lg object-cover" loading="lazy" />
                                <div>
                                    <h4 class="font-semibold text-primary">Premium Wireless Earbuds Pro</h4>
                                    <p class="text-secondary-600 text-sm">TechSound Electronics</p>
                                </div>
                            </div>

                            <!-- Star Rating -->
                            <div class="mb-4">
                                <p class="text-sm text-secondary-600 mb-2">Rate this product:</p>
                                <div class="flex space-x-1">
                                    <button class="star-rating text-warning hover:text-warning-600" data-rating="1">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                    </button>
                                    <button class="star-rating text-warning hover:text-warning-600" data-rating="2">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                    </button>
                                    <button class="star-rating text-warning hover:text-warning-600" data-rating="3">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                    </button>
                                    <button class="star-rating text-secondary-300 hover:text-warning" data-rating="4">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                    </button>
                                    <button class="star-rating text-secondary-300 hover:text-warning" data-rating="5">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <textarea class="input-field mb-4" rows="3"
                                placeholder="Share your experience with this product..."></textarea>

                            <div class="flex items-center justify-between">
                                <label class="flex items-center space-x-2 text-sm text-secondary-600">
                                    <input type="checkbox" class="rounded border-secondary-300" />
                                    <span>Add photos</span>
                                </label>
                                <button class="text-accent hover:text-accent-600 font-semibold text-sm">
                                    Submit Review
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Supplier Ratings -->
                <div class="card">
                    <h3 class="text-xl font-semibold text-primary mb-6">Rate Your Suppliers</h3>
                    <div class="space-y-6">
                        <!-- Supplier 1 Rating -->
                        <div class="border border-secondary-200 rounded-lg p-4">
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="w-12 h-12 bg-accent-100 rounded-full flex items-center justify-center">
                                    <span class="font-semibold text-accent">TS</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-primary">TechSound Electronics</h4>
                                    <p class="text-secondary-600 text-sm">3 years partnership</p>
                                </div>
                            </div>

                            <!-- Rating Categories -->
                            <div class="space-y-3 mb-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-secondary-600">Product Quality</span>
                                    <div class="flex space-x-1">
                                        <svg class="w-4 h-4 text-warning fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-warning fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-warning fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-warning fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-secondary-300 fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-secondary-600">Communication</span>
                                    <div class="flex space-x-1">
                                        <svg class="w-4 h-4 text-warning fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-warning fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-warning fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-warning fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-warning fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-secondary-600">Delivery Time</span>
                                    <div class="flex space-x-1">
                                        <svg class="w-4 h-4 text-warning fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-warning fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-warning fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-secondary-300 fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-secondary-300 fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <button class="text-accent hover:text-accent-600 font-semibold text-sm">
                                Submit Supplier Rating
                            </button>
                        </div>

                        <!-- Overall Experience -->
                        <div class="bg-accent-50 rounded-lg p-4">
                            <h4 class="font-semibold text-primary mb-3">Overall Experience</h4>
                            <textarea class="input-field mb-4" rows="3"
                                placeholder="Tell us about your overall experience with this order..."></textarea>
                            <div class="flex items-center justify-between">
                                <label class="flex items-center space-x-2 text-sm text-secondary-600">
                                    <input type="checkbox" class="rounded border-secondary-300" />
                                    <span>Recommend to others</span>
                                </label>
                                <button class="btn-primary">Share Feedback</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Tracking Redirect Modal -->
    <div id="trackingRedirectModal"
        class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 transition-all duration-300">
        <div class="bg-white rounded-xl shadow-lg max-w-sm w-full mx-4 text-center p-8 animate-scale-in">
            <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center rounded-full bg-accent/10">
                <svg class="w-10 h-10 text-accent animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-primary mb-2">Redirecting to Tracking Page...</h3>
            <p class="text-secondary-600 mb-4 text-sm">You’ll be redirected shortly to track your order. Please wait...</p>
            <div class="relative w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                <div id="redirectProgress" class="absolute left-0 top-0 h-full bg-accent rounded-full w-0"></div>
            </div>
        </div>
    </div>



    <script>
        function downloadInvoice() {
            @if (isset($order) && isset($order->id))
                const orderId = "{{ $order->id }}";
                window.location.href = `/orders/${orderId}/invoice`;
            @else
                console.warn("No order ID found for invoice download.");
                alert("Unable to download invoice — order not found.");
            @endif
                            }


        function showTrackingRedirect(orderNumber) {
            const modal = document.getElementById("trackingRedirectModal");
            const progress = document.getElementById("redirectProgress");

            modal.classList.remove("hidden", "opacity-0");
            modal.classList.add("flex");

            let width = 0;
            const interval = setInterval(() => {
                width += 2;
                progress.style.width = `${width}%`;
                if (width >= 100) {
                    clearInterval(interval);
                    window.location.href = `/track-order?order_number=${orderNumber}`;
                }
            }, 100);
        }
    </script>

@endsection