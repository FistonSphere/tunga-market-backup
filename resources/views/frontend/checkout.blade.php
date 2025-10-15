@extends('layouts.app')
@section('content')
    <style>
        .step-circle {
            width: 2rem;
            height: 2rem;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.875rem;
            background-color: #e5e7eb;
            color: #6b7280;
            transition: background-color 0.3s, color 0.3s;
        }

        .step-label {
            font-size: 0.875rem;
            color: #6b7280;
            transition: color 0.3s;
        }

        .progress-step.active .step-circle {
            background-color: #ff6b35;
            color: #fff;
        }

        .progress-step.active .step-label {
            color: #ff6b35;
            font-weight: 500;
        }

        .progress-line {
            width: 2rem;
            height: 2px;
            background-color: #e5e7eb;
            flex-shrink: 0;
        }
    </style>

    <!-- Navigation Header -->

    <!-- Breadcrumb Navigation -->
    <section class="bg-surface py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-2 text-body-sm">
                <a href="homepage.html" class="text-secondary-600 hover:text-primary transition-fast">Home</a>
                <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <a href="{{ route('cart') }}" class="text-secondary-600 hover:text-primary transition-fast">Shopping
                    Cart</a>
                <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-primary font-medium">Checkout</span>
            </nav>
        </div>

    </section>
    <!-- Checkout Header -->
    <div class="bg-white shadow-card sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <!-- Checkout Progress Indicator -->
                <div class="flex items-center space-x-4 overflow-x-auto whitespace-nowrap" id="checkoutProgress">
                    <div class="flex items-center space-x-2 progress-step" data-step="1">
                        <div class="step-circle">1</div>
                        <span class="step-label">Review Order</span>
                    </div>
                    <div class="progress-line"></div>
                    <div class="flex items-center space-x-2 progress-step" data-step="2">
                        <div class="step-circle">2</div>
                        <span class="step-label">Shipping</span>
                    </div>
                    <div class="progress-line"></div>
                    <div class="flex items-center space-x-2 progress-step" data-step="3">
                        <div class="step-circle">3</div>
                        <span class="step-label">Payment</span>
                    </div>
                    <div class="progress-line"></div>
                    <div class="flex items-center space-x-2 progress-step" data-step="4">
                        <div class="step-circle">4</div>
                        <span class="step-label">Confirmation</span>
                    </div>
                </div>


                <!-- Security Badge -->
                <div class="hidden md:flex items-center space-x-2 text-success ml-4 flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <span class="text-body-sm font-medium">Secure Checkout</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkout Header -->

    <!-- Main Checkout Content -->
    <section class="py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Checkout Steps -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Step 1: Order Review -->
                    <div id="step-1" class="checkout-step">
                        <div class="card">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-2xl font-bold text-primary">1. Order Review</h2>
                                <a href="{{ route('cart.index') }}"
                                    class="text-secondary-600 hover:text-primary transition-fast text-body-sm">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                                    </svg>
                                    Edit Cart
                                </a>
                            </div>

                            <!-- Order Items -->
                            <div class="space-y-4">
                                <div class="border border-border rounded-lg p-4">
                                    <!-- Items -->
                                    <div class="space-y-3">
                                        @foreach ($cartItems as $item)
                                            @php
                                                $hasFlash = $item->deal_id && $item->flashDeal;
                                                $effectivePrice = $hasFlash ? $item->flashDeal->flash_price : $item->product->discount_price ?? $item->product->price;
                                                $originalPrice = $item->product->price ?? $item->price;
                                            @endphp

                                            <div class="flex items-center space-x-4">
                                                <img src="{{ $item->product->main_image ?? asset('assets/images/no-image.png') }}"
                                                    alt="{{ $item->product->name }}" class="w-16 h-16 rounded-lg object-cover"
                                                    loading="lazy" />

                                                <div class="flex-1">
                                                    <h4 class="font-medium text-primary">
                                                        {{ $item->product->name }}
                                                    </h4>
                                                    <div class="text-body-sm text-secondary-600">
                                                        Qty: {{ $item->quantity }}
                                                    </div>

                                                    @if ($hasFlash)
                                                        <span
                                                            class="inline-block mt-1 text-xs bg-red-500 text-white px-2 py-0.5 rounded-full font-medium">
                                                            🔥 Flash Deal
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="text-right">
                                                    <!-- Effective Price -->
                                                    <div class="font-semibold text-primary">
                                                        {{ number_format($effectivePrice * $item->quantity) }}
                                                        {{ $item->currency }}
                                                    </div>

                                                    <!-- Strike-through original price -->
                                                    @if ($hasFlash && $originalPrice > $effectivePrice)
                                                        <div class="text-xs text-secondary-500 line-through">
                                                            {{ number_format($originalPrice * $item->quantity) }}
                                                            {{ $item->currency }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Subtotal -->
                                    <div class="bg-surface rounded-lg p-3 mt-4">
                                        <div class="flex justify-between text-body-sm">
                                            <span class="text-secondary-600">Subtotal:</span>
                                            <span class="font-medium text-primary">
                                                {{ number_format($subtotal) }} Rwf
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Continue Button -->
                            <div class="flex justify-end mt-6">
                                <button class="btn-primary" onclick="nextStep(2)">Continue to Shipping</button>
                            </div>
                        </div>
                    </div>


                    <!-- Step 2: Shipping & Address -->
                    <div id="step-2" class="checkout-step hidden">
                        <div class="card">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-2xl font-bold text-primary">2. Shipping & Address</h2>
                                <button class="text-secondary-600 hover:text-primary transition-fast text-body-sm"
                                    onclick="previousStep(1)">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                                    </svg>
                                    Back to Order Review
                                </button>
                            </div>

                            <!-- Address Management -->
                            <div class="space-y-6">
                                <!-- Saved Addresses -->
                                <div>
                                    <h3 class="font-semibold text-primary mb-4">Select Shipping Address</h3>
                                    <div class="space-y-3">
                                        @forelse($addresses as $address)
                                            <label
                                                class="flex items-start space-x-3 p-4 border border-border rounded-lg hover:bg-surface cursor-pointer">
                                                <input type="radio" name="shipping_address_id" value="{{ $address->id }}"
                                                    class="mt-1 text-accent focus:ring-accent-500 border-border" {{ $address->is_default ? 'checked' : '' }} />
                                                <div class="flex-1">
                                                    <div class="flex items-center space-x-2 mb-1">
                                                        <span class="font-medium text-primary">
                                                            {{ $address->first_name }} {{ $address->last_name }}
                                                        </span>
                                                        @if ($address->is_default)
                                                            <span
                                                                class="bg-success text-white px-2 py-0.5 rounded-full text-xs">Default</span>
                                                        @endif
                                                    </div>
                                                    <div class="text-body-sm text-secondary-700">
                                                        {!! $address->company ? $address->company . '<br>' : '' !!}
                                                        {{ $address->address_line1 }} {{ $address->address_line2 }}<br />
                                                        {{ $address->city }}, {{ $address->state }}
                                                        {{ $address->postal_code }}<br />
                                                        {{ $address->country }}<br />
                                                        Phone: {{ $address->phone }}
                                                    </div>
                                                    <button type="button"
                                                        class="edit-address-btn text-accent hover:text-accent-600 transition-fast text-body-sm mt-2"
                                                        data-id="{{ $address->id }}">
                                                        Edit
                                                    </button>
                                                </div>
                                            </label>
                                        @empty
                                            <p class="text-body-sm text-secondary-600">No saved addresses. Please add one
                                                below.</p>
                                        @endforelse

                                        <!-- Add New Address -->
                                        <label
                                            class="flex items-start space-x-3 p-4 border-2 border-dashed border-border rounded-lg hover:bg-surface cursor-pointer">
                                            <input type="radio" name="shipping-address" value="new"
                                                class="mt-1 text-accent focus:ring-accent-500 border-border" />
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-2 mb-1">
                                                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                    </svg>
                                                    <span class="font-medium text-primary">Add New Address</span>
                                                </div>
                                                <div class="text-body-sm text-secondary-600">
                                                    Enter a new shipping address
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                </div>

                                <!-- New Address Form (Hidden by default) -->
                                <div id="new-address-form" class="hidden">
                                    <form id="add-address-form" method="POST"
                                        action="{{ route('shipping-address.store') }}">
                                        @csrf
                                        <h4 class="font-semibold text-primary mb-4">New Shipping Address</h4>
                                        <div class="grid md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-body-sm font-medium text-primary mb-1">First Name
                                                    *</label>
                                                <input type="text" name="first_name" class="input-field" required />
                                            </div>
                                            <div>
                                                <label class="block text-body-sm font-medium text-primary mb-1">Last Name
                                                    *</label>
                                                <input type="text" name="last_name" class="input-field" required />
                                            </div>
                                            <div class="md:col-span-2">
                                                <label class="block text-body-sm font-medium text-primary mb-1">Company
                                                    (Optional)</label>
                                                <input type="text" name="company" class="input-field" />
                                            </div>
                                            <div class="md:col-span-2">
                                                <label class="block text-body-sm font-medium text-primary mb-1">Address
                                                    Line 1 *</label>
                                                <input type="text" name="address_line1" class="input-field" required />
                                            </div>
                                            <div class="md:col-span-2">
                                                <label class="block text-body-sm font-medium text-primary mb-1">Address
                                                    Line 2 (Optional)</label>
                                                <input type="text" name="address_line2" class="input-field" />
                                            </div>

                                            <div>
                                                <label class="block text-body-sm font-medium text-primary mb-1">Country
                                                    *</label>
                                                <select id="countySel" name="country" class="input-field" required>
                                                    <option value="">Select Country</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-body-sm font-medium text-primary mb-1">State/Province
                                                    *</label>
                                                <select id="stateSel" name="state" class="input-field" required>
                                                    <option value="">Select State</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-body-sm font-medium text-primary mb-1">City/District
                                                    *</label>
                                                <select id="districtSel" name="city" class="input-field" required>
                                                    <option value="">Select City/District</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-body-sm font-medium text-primary mb-1">ZIP/Postal
                                                    Code</label>
                                                <input type="text" name="postal_code" class="input-field" />
                                            </div>
                                            <div class="md:col-span-2">
                                                <label class="block text-body-sm font-medium text-primary mb-1">Phone
                                                    Number *</label>
                                                <input type="tel" name="phone" class="input-field" required />
                                            </div>
                                        </div>

                                        <div class="flex items-center space-x-3 mt-4">
                                            <input type="checkbox" id="save-address" name="save" value="1"
                                                class="w-4 h-4 text-accent focus:ring-accent-500 border-border rounded" />
                                            <label for="save-address" class="text-body-sm text-secondary-700">
                                                Save this address for future orders
                                            </label>
                                        </div>

                                        <button type="button" onclick="openAddressConfirmModal()"
                                            class="mt-4 px-4 py-2 bg-accent text-white rounded-lg shadow hover:bg-accent-dark">
                                            Save Address
                                        </button>
                                    </form>
                                </div>

                                <!-- Shipping Options -->
                                <div>
                                    <h3 class="font-semibold text-primary mb-4">Shipping Options</h3>
                                    <div class="space-y-3">
                                        <!-- TechSound Manufacturing Shipping -->
                                        <div class="border border-border rounded-lg p-4">
                                            <h4 class="font-medium text-primary mb-3">Tunga Market Shipping Co Ltd.</h4>
                                            <div class="space-y-2">
                                                <label
                                                    class="flex items-center justify-between p-3 border border-border rounded-lg hover:bg-surface cursor-pointer">
                                                    <div class="flex items-center space-x-3">
                                                        <input type="radio" name="shipping-techsound" value="free"
                                                            class="text-accent focus:ring-accent-500 border-border"
                                                            checked />
                                                        <div>
                                                            <div class="font-medium text-primary">Free Standard Shipping
                                                            </div>
                                                            <div class="text-body-sm text-secondary-600">30 min - 24 hrs
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <div class="font-semibold text-success">FREE</div>
                                                        <div class="text-body-sm text-secondary-600">Tracking included
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="flex justify-between mt-8">
                                <button class="btn-secondary" onclick="previousStep(1)">Back to Order Review</button>
                                <button class="btn-primary" onclick="nextStep(3)">Continue to Payment</button>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Payment -->
                    <div id="step-3" class="checkout-step hidden">
                        <div class="card">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-2xl font-bold text-primary">
                                    3. Payment Method
                                </h2>
                                <button class="text-secondary-600 hover:text-primary transition-fast text-body-sm"
                                    onclick="previousStep(2)">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                                    </svg>
                                    Back to Shipping
                                </button>
                            </div>

                            <!-- Security Notice -->
                            <div class="bg-success-50 border border-success-200 rounded-lg p-4 mb-6">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-6 h-6 text-success flex-shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.09-5.09A10 10 0 0019.49 5 8.5 8.5 0 0013 8a10 10 0 00-7.07 7.07A8.5 8.5 0 003 12.5a10 10 0 007.07-7.07zM12 12a5.5 5.5 0 1111 0 5.5 5.5 0 01-11 0z" />
                                    </svg>
                                    <div>
                                        <h4 class="font-semibold text-success mb-1">
                                            Your payment is protected
                                        </h4>
                                        <p class="text-body-sm text-success-700">
                                            256-bit SSL encryption • PCI DSS compliant • Buyer
                                            protection guarantee
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Methods -->
                            <div class="space-y-6">
                                <!-- Credit/Debit Card -->
                                <div>
                                    <label class="flex items-center space-x-3 mb-4">
                                        <input type="radio" name="payment-method" value="card"
                                            class="text-accent focus:ring-accent-500 border-border" checked />
                                        <span class="font-semibold text-primary">Credit/Debit Card</span>
                                        <div class="flex items-center space-x-2 ml-auto">
                                            <div
                                                class="w-8 h-5 bg-primary rounded text-white text-xs flex items-center justify-center font-bold">
                                                VISA
                                            </div>
                                            <div
                                                class="w-8 h-5 bg-accent rounded text-white text-xs flex items-center justify-center font-bold">
                                                MC
                                            </div>
                                            <div
                                                class="w-8 h-5 bg-secondary rounded text-white text-xs flex items-center justify-center font-bold">
                                                AMEX
                                            </div>
                                        </div>
                                    </label>

                                    <div id="card-form" class="space-y-4 pl-7">
                                        <!-- Saved Cards -->
                                        <div class="space-y-3">
                                            <h4 class="font-medium text-primary">
                                                Saved Payment Methods
                                            </h4>

                                            <label
                                                class="flex items-center justify-between p-4 border border-border rounded-lg hover:bg-surface cursor-pointer">
                                                <div class="flex items-center space-x-3">
                                                    <input type="radio" name="saved-card" value="card1"
                                                        class="text-accent focus:ring-accent-500 border-border" />
                                                    <div
                                                        class="w-8 h-5 bg-primary rounded text-white text-xs flex items-center justify-center font-bold">
                                                        VISA
                                                    </div>
                                                    <div>
                                                        <div class="font-medium text-primary">
                                                            •••• •••• •••• 1234
                                                        </div>
                                                        <div class="text-body-sm text-secondary-600">
                                                            Expires 12/26 • John Smith
                                                        </div>
                                                    </div>
                                                </div>
                                                <button
                                                    class="text-accent hover:text-accent-600 transition-fast text-body-sm">
                                                    Edit
                                                </button>
                                            </label>

                                            <label
                                                class="flex items-center space-x-3 p-4 border-2 border-dashed border-border rounded-lg hover:bg-surface cursor-pointer">
                                                <input type="radio" name="saved-card" value="new-card"
                                                    class="text-accent focus:ring-accent-500 border-border" checked />
                                                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                                <span class="font-medium text-primary">Add New Card</span>
                                            </label>
                                        </div>

                                        <!-- New Card Form -->
                                        <div id="new-card-form" class="space-y-4">
                                            <div>
                                                <label class="block text-body-sm font-medium text-primary mb-1">Card Number
                                                    *</label>
                                                <input type="text" class="input-field" placeholder="1234 5678 9012 3456"
                                                    maxlength="19" required />
                                            </div>

                                            <div class="grid md:grid-cols-3 gap-4">
                                                <div class="md:col-span-2">
                                                    <label class="block text-body-sm font-medium text-primary mb-1">Expiry
                                                        Date *</label>
                                                    <input type="text" class="input-field" placeholder="MM/YY" maxlength="5"
                                                        required />
                                                </div>
                                                <div>
                                                    <label class="block text-body-sm font-medium text-primary mb-1">CVV
                                                        *</label>
                                                    <input type="text" class="input-field" placeholder="123" maxlength="4"
                                                        required />
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-body-sm font-medium text-primary mb-1">Cardholder
                                                    Name *</label>
                                                <input type="text" class="input-field" placeholder="John Smith" required />
                                            </div>

                                            <div class="flex items-center space-x-3">
                                                <input type="checkbox" id="save-card"
                                                    class="w-4 h-4 text-accent focus:ring-accent-500 border-border rounded" />
                                                <label for="save-card" class="text-body-sm text-secondary-700">Save this
                                                    card for future purchases</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- IREMBO Pay -->
                                <div>
                                    <label class="flex items-center space-x-3 mb-4">
                                        <input type="radio" name="payment-method" value="irembo-pay"
                                            class="text-accent focus:ring-accent-500 border-border" />
                                        <span class="font-semibold text-primary">IREMBO Pay</span>
                                        <div class="flex items-center space-x-2 ml-auto">
                                            <div
                                                class="w-12 h-6 bg-gradient-to-r from-green-500 to-blue-500 rounded text-white text-xs flex items-center justify-center font-bold">
                                                IREMBO
                                            </div>
                                            <div
                                                class="w-8 h-5 bg-yellow-500 rounded text-white text-xs flex items-center justify-center font-bold">
                                                MTN
                                            </div>
                                            <div
                                                class="w-10 h-5 bg-red-500 rounded text-white text-xs flex items-center justify-center font-bold">
                                                AIRTEL
                                            </div>
                                        </div>
                                    </label>

                                    <div id="irembo-form" class="space-y-4 pl-7 hidden">
                                        <div class="bg-primary-50 border border-primary-200 rounded-lg p-4 mb-4">
                                            <div class="flex items-center space-x-3">
                                                <svg class="w-6 h-6 text-primary flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                                <div>
                                                    <h4 class="font-semibold text-primary mb-1">
                                                        IREMBO Pay - Mobile Money
                                                    </h4>
                                                    <p class="text-body-sm text-primary-700">
                                                        Secure mobile money payments in Rwanda. Supports
                                                        MTN Mobile Money and Airtel Money.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Mobile Money Provider Selection -->
                                        <div>
                                            <label class="block text-body-sm font-medium text-primary mb-2">Select Mobile
                                                Money Provider *</label>
                                            <div class="grid grid-cols-2 gap-3">
                                                <label
                                                    class="flex items-center justify-center p-4 border border-border rounded-lg cursor-pointer hover:bg-surface transition-fast">
                                                    <input type="radio" name="mobile-provider" value="mtn"
                                                        class="sr-only" />
                                                    <div class="text-center">
                                                        <div
                                                            class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-2">
                                                            <span class="text-white font-bold text-sm">MTN</span>
                                                        </div>
                                                        <div class="font-semibold text-primary">
                                                            MTN Mobile Money
                                                        </div>
                                                        <div class="text-sm text-secondary-600">
                                                            *182# or App
                                                        </div>
                                                    </div>
                                                </label>

                                                <label
                                                    class="flex items-center justify-center p-4 border border-border rounded-lg cursor-pointer hover:bg-surface transition-fast">
                                                    <input type="radio" name="mobile-provider" value="airtel"
                                                        class="sr-only" />
                                                    <div class="text-center">
                                                        <div
                                                            class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center mx-auto mb-2">
                                                            <span class="text-white font-bold text-sm">AIRTEL</span>
                                                        </div>
                                                        <div class="font-semibold text-primary">
                                                            Airtel Money
                                                        </div>
                                                        <div class="text-sm text-secondary-600">
                                                            *175# or App
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Payment Method Selection -->
                                        <div id="payment-method-selection" class="hidden">
                                            <label class="block text-body-sm font-medium text-primary mb-2">How would you
                                                like to pay?</label>
                                            <div class="space-y-3">
                                                <!-- Phone Number Payment -->
                                                <label
                                                    class="flex items-start space-x-3 p-4 border border-border rounded-lg hover:bg-surface cursor-pointer">
                                                    <input type="radio" name="payment-type" value="phone"
                                                        class="mt-1 text-accent focus:ring-accent-500 border-border" />
                                                    <div class="flex-1">
                                                        <div class="flex items-center space-x-2 mb-1">
                                                            <svg class="w-5 h-5 text-accent" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                            </svg>
                                                            <span class="font-medium text-primary">Pay with Phone
                                                                Number</span>
                                                        </div>
                                                        <div class="text-body-sm text-secondary-600">
                                                            Enter your mobile money phone number. You'll
                                                            receive a payment request on your phone.
                                                        </div>
                                                    </div>
                                                </label>

                                                <!-- Mobile Money Code Payment (MTN Only) -->
                                                <label
                                                    class="flex items-start space-x-3 p-4 border border-border rounded-lg hover:bg-surface cursor-pointer"
                                                    id="code-payment-option">
                                                    <input type="radio" name="payment-type" value="code"
                                                        class="mt-1 text-accent focus:ring-accent-500 border-border" />
                                                    <div class="flex-1">
                                                        <div class="flex items-center space-x-2 mb-1">
                                                            <svg class="w-5 h-5 text-accent" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                                            </svg>
                                                            <span class="font-medium text-primary">Pay with Mobile Money
                                                                Code</span>
                                                            <span
                                                                class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-semibold">MTN
                                                                Only</span>
                                                        </div>
                                                        <div class="text-body-sm text-secondary-600">
                                                            Generate a payment code from MTN Mobile Money
                                                            app or *182# and enter it here.
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Phone Number Input -->
                                        <div id="phone-input-section" class="hidden">
                                            <label class="block text-body-sm font-medium text-primary mb-1">Mobile Money
                                                Phone Number *</label>
                                            <div class="flex">
                                                <div
                                                    class="flex items-center px-3 bg-surface border border-r-0 border-border rounded-l-lg">
                                                    <span class="text-secondary-600">+250</span>
                                                </div>
                                                <input type="tel" id="mobile-phone"
                                                    class="flex-1 input-field rounded-l-none" placeholder="7xxxxxxxx"
                                                    maxlength="9" required />
                                            </div>
                                            <p class="text-body-sm text-secondary-600 mt-1">
                                                Enter your 9-digit mobile number (without +250)
                                            </p>
                                        </div>

                                        <!-- Mobile Money Code Input -->
                                        <div id="code-input-section" class="hidden">
                                            <label class="block text-body-sm font-medium text-primary mb-1">Mobile Money
                                                Payment Code *</label>
                                            <input type="text" id="mobile-code" class="input-field"
                                                placeholder="Enter 6-digit payment code" maxlength="6" required />
                                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mt-2">
                                                <h5 class="font-medium text-yellow-800 mb-1">
                                                    How to get your payment code:
                                                </h5>
                                                <ol class="text-body-sm text-yellow-700 space-y-1">
                                                    <li>1. Dial *182# on your MTN phone</li>
                                                    <li>2. Select "Pay Bill" or "Send Money"</li>
                                                    <li>
                                                        3. Enter merchant code: <strong>123456</strong>
                                                    </li>
                                                    <li>
                                                        4. Enter amount:
                                                        <strong>$<span id="payment-amount">711.36</span></strong>
                                                    </li>
                                                    <li>5. Generate payment code and enter it above</li>
                                                </ol>
                                            </div>
                                        </div>

                                        <!-- PIN Input for Both Methods -->
                                        <div id="pin-input-section" class="hidden">
                                            <label class="block text-body-sm font-medium text-primary mb-1">Mobile Money
                                                PIN *</label>
                                            <input type="password" id="mobile-pin" class="input-field"
                                                placeholder="Enter your 4-digit PIN" maxlength="4" required />
                                            <p class="text-body-sm text-secondary-600 mt-1">
                                                Your mobile money PIN for transaction authorization
                                            </p>
                                        </div>

                                        <!-- Payment Instructions -->
                                        <div id="payment-instructions"
                                            class="hidden bg-accent-50 border border-accent-200 rounded-lg p-4">
                                            <h5 class="font-semibold text-accent mb-2">
                                                Payment Instructions
                                            </h5>
                                            <div id="phone-instructions" class="hidden">
                                                <p class="text-body-sm text-accent-700 mb-2">
                                                    When you click "Place Order":
                                                </p>
                                                <ol class="text-body-sm text-accent-700 space-y-1 list-decimal list-inside">
                                                    <li>
                                                        You'll receive a payment request on your phone
                                                    </li>
                                                    <li>Enter your Mobile Money PIN to confirm</li>
                                                    <li>Your order will be processed immediately</li>
                                                </ol>
                                            </div>
                                            <div id="code-instructions" class="hidden">
                                                <p class="text-body-sm text-accent-700 mb-2">
                                                    Your payment will be processed using the provided
                                                    code:
                                                </p>
                                                <ul class="text-body-sm text-accent-700 space-y-1 list-disc list-inside">
                                                    <li>
                                                        Ensure your mobile money account has sufficient
                                                        balance
                                                    </li>
                                                    <li>Payment code is valid for 15 minutes</li>
                                                    <li>
                                                        Your order will be confirmed once payment is
                                                        successful
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="flex justify-between mt-8">
                                <button class="btn-secondary" onclick="previousStep(2)">
                                    Back to Shipping
                                </button>
                                <button class="btn-primary" onclick="nextStep(4)">
                                    Review & Place Order
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Order Confirmation -->
                    <div id="step-4" class="checkout-step hidden">
                        <div class="card">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-2xl font-bold text-primary">4. Order Confirmation</h2>
                                <button class="text-secondary-600 hover:text-primary transition-fast text-body-sm"
                                    onclick="previousStep(3)">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                                    </svg>
                                    Back to Payment
                                </button>
                            </div>

                            <!-- Order Summary Review -->
                            <div class="space-y-6">
                                <!-- Shipping Address Summary -->
                                <div class="border border-border rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-3">
                                        <h3 class="font-semibold text-primary">Shipping Address</h3>
                                        <button class="text-accent hover:text-accent-600 transition-fast text-body-sm"
                                            onclick="editStep(2)">Edit</button>
                                    </div>
                                    <div class="text-body-sm text-secondary-700">
                                        John Smith<br />
                                        123 Main Street, Apt 4B<br />
                                        New York, NY 10001<br />
                                        United States<br />
                                        Phone: +1 (555) 123-4567
                                    </div>
                                </div>

                                <!-- Payment Method Summary -->
                                <div class="border border-border rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-3">
                                        <h3 class="font-semibold text-primary">Payment Method</h3>
                                        <button class="text-accent hover:text-accent-600 transition-fast text-body-sm"
                                            onclick="editStep(3)">Edit</button>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-8 h-5 bg-primary rounded text-white text-xs flex items-center justify-center font-bold">
                                            VISA</div>
                                        <span class="text-body-sm text-secondary-700">•••• •••• •••• 1234</span>
                                    </div>
                                </div>

                                <!-- Delivery Information -->
                                <div class="border border-border rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-3">
                                        <h3 class="font-semibold text-primary">Delivery Information</h3>
                                    </div>
                                    <div class="space-y-2 text-body-sm">
                                        <div class="flex justify-between">
                                            <span class="text-secondary-600">Tunga Market:</span>
                                            <span class="text-primary">30 min - 24 hours (Free shipping)</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Terms and Conditions -->
                                <div class="border border-border rounded-lg p-4">
                                    <h3 class="font-semibold text-primary mb-3">Terms & Conditions</h3>
                                    <div class="space-y-3">
                                        <label class="flex items-start space-x-3">
                                            <input type="checkbox" id="terms-conditions"
                                                class="w-4 h-4 text-accent focus:ring-accent-500 border-border rounded mt-0.5"
                                                required />
                                            <span class="text-body-sm text-secondary-700">I agree to the <a
                                                    href="{{ route('terms.and.conditions') }}"
                                                    class="text-accent hover:underline" target="_blank">Terms of Service</a>
                                                and <a href="{{ route('privacy.policy') }}"
                                                    class="text-accent hover:underline" target="_blank">Privacy
                                                    Policy</a></span>
                                        </label>

                                        <label class="flex items-start space-x-3">
                                            <input type="checkbox" id="supplier-terms"
                                                class="w-4 h-4 text-accent focus:ring-accent-500 border-border rounded mt-0.5"
                                                required />
                                            <span class="text-body-sm text-secondary-700">I acknowledge the supplier terms
                                                and delivery conditions</span>
                                        </label>

                                        <label class="flex items-start space-x-3">
                                            <input type="checkbox" id="marketing-emails"
                                                class="w-4 h-4 text-accent focus:ring-accent-500 border-border rounded mt-0.5" />
                                            <span class="text-body-sm text-secondary-700">I want to receive marketing
                                                emails about special offers and new products</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Buyer Protection Info -->
                                <div class="bg-primary-50 border border-primary-200 rounded-lg p-4">
                                    <h3 class="font-semibold text-primary mb-3">Your Purchase is Protected</h3>
                                    <div class="grid md:grid-cols-2 gap-4 text-body-sm">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-success flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-secondary-700">30-day money back guarantee</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-success flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-secondary-700">Quality assurance program</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-success flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-secondary-700">Dispute resolution support</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-success flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-secondary-700">24/7 customer support</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Place Order Button -->
                            <div class="flex justify-between mt-8">
                                <button class="btn-secondary" onclick="previousStep(3)">Back to Payment</button>
                                <button class="btn-primary bg-success hover:bg-success-600 text-lg px-8 py-4"
                                    onclick="placeOrder()">
                                    Place Order - $711.36
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-6">
                        <!-- Order Summary -->
                        <div class="card">
                            <h3 class="font-semibold text-primary mb-4">Order Summary</h3>

                            <!-- Items Summary -->
                            <div class="space-y-3 mb-4">
                                @foreach ($cartItems as $item)
                                    @php
                                        $hasFlash = $item->deal_id && $item->flashDeal;
                                        $effectivePrice = $hasFlash ? $item->flashDeal->flash_price : $item->product->discount_price ?? $item->product->price;
                                        $originalPrice = $item->product->price ?? $item->price;
                                    @endphp

                                    <div class="flex items-center space-x-3">
                                        <img src="{{ $item->product->main_image ?? asset('assets/images/no-image.png') }}"
                                            alt="{{ $item->product->name }}" class="w-12 h-12 rounded-lg object-cover"
                                            loading="lazy" />

                                        <div class="flex-1">
                                            <div class="font-medium text-primary text-body-sm">
                                                {{ $item->product->name }}
                                            </div>

                                            <div class="text-body-sm text-secondary-600">
                                                Qty: {{ $item->quantity }} •
                                                <span class="{{ $hasFlash ? 'text-accent font-semibold' : '' }}">
                                                    {{ number_format($effectivePrice) }} {{ $item->product->currency }}
                                                </span> each
                                            </div>

                                            @if($hasFlash && $originalPrice > $effectivePrice)
                                                <div class="text-xs text-secondary-500 line-through">
                                                    {{ number_format($originalPrice) }} {{ $item->product->currency }}
                                                </div>
                                                <span
                                                    class="inline-block mt-1 text-xs bg-red-500 text-white px-2 py-0.5 rounded-full font-medium">
                                                    🔥 Flash Deal
                                                </span>
                                            @endif
                                        </div>

                                        <div class="text-right">
                                            <div class="font-medium text-primary">
                                                {{ number_format($effectivePrice * $item->quantity) }}
                                                {{ $item->product->currency }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Totals -->
                            <div class="border-t border-border pt-4 space-y-3 text-body-sm">
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">
                                        Subtotal ({{ $cartItems->sum('quantity') }} items):
                                    </span>
                                    <span class="font-medium text-primary">
                                        {{ number_format($subtotal) }} {{ $item->product->currency }}
                                    </span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Shipping:</span>
                                    <span class="font-medium text-success">Free</span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Tax (estimated):</span>
                                    <span class="font-medium text-primary">{{ number_format($tax) }}
                                        {{ $item->product->currency }}</span>
                                </div>

                                <div class="border-t border-border pt-3">
                                    <div class="flex justify-between">
                                        <span class="font-semibold text-primary">Total:</span>
                                        <span class="text-xl font-bold text-primary">{{ number_format($total) }}
                                            {{ $item->product->currency }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
    </section>

    <!-- Mobile Progress Bar -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-border p-4 z-40">
        <div class="flex items-center justify-between mb-3">
            <div class="text-body-sm text-secondary-600">Step <span id="mobile-step">1</span> of 4</div>
            <div class="text-lg font-bold text-primary" id="mobile-total">$711.36</div>
        </div>
        <div class="w-full bg-border rounded-full h-2">
            <div id="mobile-progress" class="bg-accent h-2 rounded-full transition-all duration-300" style="width: 25%">
            </div>
        </div>
    </div>

    <!-- 🛑 Save Address Confirmation Modal -->
    <div id="save-address-modal-wrapper"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div
            class="bg-white rounded-2xl shadow-modal w-full max-w-md mx-auto transform transition-all duration-300 relative p-8">

            <!-- Close Button -->
            <button onclick="closeAddressConfirmModal()"
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
            <h2 class="text-2xl font-bold text-primary mb-3 text-center">Save this Address?</h2>
            <p class="text-body text-secondary-600 mb-6 leading-relaxed text-center">
                Are you sure this shipping address is correct?
            </p>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <button id="confirm-save-btn" onclick="confirmSaveAddress()"
                    class="w-full bg-accent text-white py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                    <span id="confirm-save-text">Yes, Save Address</span>
                    <svg id="confirm-save-spinner" class="animate-spin h-5 w-5 ml-2 text-white hidden"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                </button>
                <button onclick="closeAddressConfirmModal()"
                    class="text-secondary-500 hover:text-accent transition-fast text-body-sm font-medium w-full">
                    Cancel
                </button>
            </div>
        </div>
    </div>
    <div id="toast"
        class="hidden fixed bottom-5 right-5 bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg flex items-center space-x-2 z-50"
        style="z-index: 999999;--tw-bg-opacity: 1;background-color: rgb(22 163 74 / var(--tw-bg-opacity, 1)); color: #fff;top: 8px;right: 4px;">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span>Shipping address has been saved successfully!</span>
    </div>
    <div id="toast2"
        class="hidden fixed bottom-5 right-5 bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg flex items-center space-x-2 z-50"
        style="z-index: 999999;--tw-bg-opacity: 1;background-color: rgb(22 163 74 / var(--tw-bg-opacity, 1));color: #fff;top: 8px;right: 4px;">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span>Shipping address has been updated successfully!</span>
    </div>

    <!-- Edit Address Modal -->
    <div id="editAddressModal"
        style="z-index: 99999;--tw-bg-opacity: 0.3;background-color: rgb(0 0 0 / var(--tw-bg-opacity, 0.3));" class="fixed inset-0 hidden items-center justify-center
                                            backdrop-blur-sm transition-opacity duration-300 ease-out">

        <!-- Animated Modal Card -->
        <div id="editAddressCard" class="bg-white rounded-2xl shadow-lg w-full max-w-3xl p-0 relative flex flex-col md:flex-row
                                               transform scale-95 opacity-0 transition-all duration-300 ease-out">

            <!-- Left Side: Form -->
            <div class="flex-1 p-8 relative">
                <!-- Close Button -->
                <button type="button" id="closeEditModal"
                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-lg">
                    ✕
                </button>

                <h2 class="text-lg font-semibold mb-4 text-primary">Edit Shipping Address</h2>

                <form id="editAddressForm" class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-[70vh] overflow-y-auto p-2">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">

                    <div>
                        <label class="block text-xs font-medium text-primary mb-1">First Name *</label>
                        <input type="text" id="edit_first_name" name="first_name" class="input-field py-1 text-sm" required>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-primary mb-1">Last Name *</label>
                        <input type="text" id="edit_last_name" name="last_name" class="input-field py-1 text-sm" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-primary mb-1">Company (Optional)</label>
                        <input type="text" id="edit_company" name="company" class="input-field py-1 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-primary mb-1">Address Line 1 *</label>
                        <input type="text" id="edit_address_line1" name="address_line1" class="input-field py-1 text-sm"
                            required>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-primary mb-1">Address Line 2 (Optional)</label>
                        <input type="text" id="edit_address_line2" name="address_line2" class="input-field py-1 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-primary mb-1">Country *</label>
                        <input type="text" id="edit_country" name="country" class="input-field py-1 text-sm" required>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-primary mb-1">State/Province *</label>
                        <input type="text" id="edit_state" name="state" class="input-field py-1 text-sm" required>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-primary mb-1">City/District *</label>
                        <input type="text" id="edit_city" name="city" class="input-field py-1 text-sm" required>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-primary mb-1">ZIP/Postal Code</label>
                        <input type="text" id="edit_postal_code" name="postal_code" class="input-field py-1 text-sm">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-primary mb-1">Phone Number *</label>
                        <input type="tel" id="edit_phone" name="phone" class="input-field py-1 text-sm" required>
                    </div>

                    <div class="md:col-span-2 flex justify-end mt-4">
                        <button type="submit"
                            class="bg-accent text-white px-6 py-3 rounded-lg shadow hover:bg-accent-dark flex items-center space-x-2 text-base font-semibold">
                            <span id="editBtnText">Save</span>
                            <span id="editSpinner"
                                class="hidden animate-spin border-2 border-white border-t-transparent rounded-full w-5 h-5"></span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Side: Illustration -->
            <div class="hidden md:flex flex-col justify-center items-center bg-surface rounded-r-2xl w-80 p-8 border-l border-border"
                style="border-top-right-radius: 16px; border-bottom-right-radius: 16px;">
                <svg class="w-24 h-24 text-accent mb-4" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                    <rect x="8" y="12" width="32" height="24" rx="4" stroke-width="2" />
                    <path d="M16 20h16M16 28h8" stroke-width="2" />
                </svg>
                <div class="text-primary font-semibold text-lg mb-2 text-center">Keep your address up to date!</div>
                <div class="text-secondary-600 text-sm text-center">Accurate shipping details ensure fast and secure
                    delivery of your orders.</div>
            </div>
        </div>
    </div>



    <script src="{{ asset('assets/js/CountryStateDistrictCityData.js') }}"></script>

    <script>
        let currentStep = 1;

        // Show a given step
        function showStep(step) {
            // hide all
            document.querySelectorAll(".checkout-step").forEach((el) => {
                el.classList.add("hidden");
            });

            // show target step
            document.getElementById(`step-${step}`).classList.remove("hidden");

            // update tracker
            currentStep = step;
            updateProgress(step);
        }

        // Next button handler
        function nextStep(step) {
            // validate the CURRENT step before moving forward
            if (!validateStep(currentStep)) return;

            showStep(step);
        }

        // Previous button handler
        function previousStep(step) {
            showStep(step);
        }

        // Validation per step
        function validateStep(step) {

            if (step === 2) {
                // Ensure a shipping address is selected
                const addressSelected = document.querySelector('input[name="shipping_address_id"]:checked');
                if (!addressSelected) {
                    alert("Please select a shipping address.");
                    return false;
                }

                // Ensure a shipping option is selected
                const shippingSelected = document.querySelector('input[name^="shipping-"]:checked');
                if (!shippingSelected) {
                    alert("Please select a shipping option.");
                    return false;
                }
            }

            if (step === 3) {
                // Ensure a payment method is selected
                const paymentSelected = document.querySelector('input[name="payment-method"]:checked');
                if (!paymentSelected) {
                    alert("Please select a payment method.");
                    return false;
                }
            }

            return true;
        }

        // Progress indicator (optional, if you have step UI)
        function updateProgress(step) {
            document.querySelectorAll(".progress-step").forEach((el) => {
                const stepNum = parseInt(el.getAttribute("data-step"));
                if (stepNum <= step) {
                    el.classList.add("active");
                } else {
                    el.classList.remove("active");
                }
            });
        }


        // init
        document.addEventListener("DOMContentLoaded", () => {
            showStep(1);
        });


        function updateProgressIndicators(step) {
            // Update desktop progress
            const steps = document.querySelectorAll(
                '[class*="w-8"][class*="h-8"][class*="rounded-full"]'
            );

            steps.forEach((stepEl, index) => {
                const stepNumber = index + 1;
                if (stepNumber <= step) {
                    stepEl.classList.remove("bg-border", "text-secondary-600");
                    stepEl.classList.add("bg-accent", "text-white");
                } else {
                    stepEl.classList.remove("bg-accent", "text-white");
                    stepEl.classList.add("bg-border", "text-secondary-600");
                }
            });
        }

        function validateCurrentStep() {
            switch (currentStep) {
                case 1:
                    return true; // Order review always valid
                case 2:
                    return validateShippingStep();
                case 3:
                    return validatePaymentStep();
                case 4:
                    return validateConfirmationStep();
                default:
                    return true;
            }
        }

        function validateShippingStep() {
            const shippingAddress = document.querySelector(
                'input[name="shipping-address"]:checked'
            );
            if (!shippingAddress) {
                showToast(
                    "Address Required",
                    "Please select a shipping address.",
                    "warning"
                );
                return false;
            }

            if (shippingAddress.value === "new") {
                const requiredFields = document.querySelectorAll(
                    "#new-address-form input[required], #new-address-form select[required]"
                );
                for (let field of requiredFields) {
                    if (!field.value.trim()) {
                        showToast(
                            "Complete Address",
                            "Please fill in all required address fields.",
                            "warning"
                        );
                        field.focus();
                        return false;
                    }
                }
            }

            return true;
        }

        function validatePaymentStep() {
            const paymentMethod = document.querySelector(
                'input[name="payment-method"]:checked'
            );
            if (!paymentMethod) {
                showToast(
                    "Payment Required",
                    "Please select a payment method.",
                    "warning"
                );
                return false;
            }

            if (paymentMethod.value === "card") {
                const savedCard = document.querySelector(
                    'input[name="saved-card"]:checked'
                );
                if (savedCard && savedCard.value === "new-card") {
                    const requiredFields = document.querySelectorAll(
                        "#new-card-form input[required]"
                    );
                    for (let field of requiredFields) {
                        if (!field.value.trim()) {
                            showToast(
                                "Complete Payment Info",
                                "Please fill in all required payment fields.",
                                "warning"
                            );
                            field.focus();
                            return false;
                        }
                    }
                }
            } else if (paymentMethod.value === "irembo-pay") {
                return validateIREMBOPay();
            }

            return true;
        }

        function validateIREMBOPay() {
            const provider = document.querySelector(
                'input[name="mobile-provider"]:checked'
            );
            if (!provider) {
                showToast(
                    "Provider Required",
                    "Please select a mobile money provider.",
                    "warning"
                );
                return false;
            }

            const paymentType = document.querySelector(
                'input[name="payment-type"]:checked'
            );
            if (!paymentType) {
                showToast(
                    "Payment Type Required",
                    "Please select how you want to pay.",
                    "warning"
                );
                return false;
            }

            if (paymentType.value === "phone") {
                const phoneInput = document.getElementById("mobile-phone");
                if (!phoneInput.value.trim() || phoneInput.value.length !== 9) {
                    showToast(
                        "Valid Phone Required",
                        "Please enter a valid 9-digit phone number.",
                        "warning"
                    );
                    phoneInput.focus();
                    return false;
                }
            } else if (paymentType.value === "code") {
                const codeInput = document.getElementById("mobile-code");
                if (!codeInput.value.trim() || codeInput.value.length !== 6) {
                    showToast(
                        "Valid Code Required",
                        "Please enter a valid 6-digit payment code.",
                        "warning"
                    );
                    codeInput.focus();
                    return false;
                }
            }

            const pinInput = document.getElementById("mobile-pin");
            if (!pinInput.value.trim() || pinInput.value.length !== 4) {
                showToast(
                    "PIN Required",
                    "Please enter your 4-digit mobile money PIN.",
                    "warning"
                );
                pinInput.focus();
                return false;
            }

            return true;
        }

        function validateConfirmationStep() {
            const termsChecked =
                document.getElementById("terms-conditions")?.checked;
            const supplierTermsChecked =
                document.getElementById("supplier-terms")?.checked;

            if (!termsChecked || !supplierTermsChecked) {
                showToast(
                    "Accept Terms",
                    "Please accept the terms and conditions to continue.",
                    "warning"
                );
                return false;
            }

            return true;
        }

        // IREMBO Pay specific functions
        function handlePaymentMethodChange() {
            const paymentMethods = document.querySelectorAll(
                'input[name="payment-method"]'
            );
            const iremboForm = document.getElementById("irembo-form");
            const cardForm = document.getElementById("card-form");

            paymentMethods.forEach((method) => {
                method.addEventListener("change", function () {
                    // Hide all payment forms first
                    if (iremboForm) iremboForm.classList.add("hidden");
                    if (cardForm) cardForm.classList.add("hidden");

                    // Show relevant form
                    if (this.value === "irembo-pay" && iremboForm) {
                        iremboForm.classList.remove("hidden");
                    } else if (this.value === "card" && cardForm) {
                        cardForm.classList.remove("hidden");
                    }
                });
            });
        }

        function handleMobileProviderChange() {
            const providers = document.querySelectorAll(
                'input[name="mobile-provider"]'
            );
            const paymentMethodSelection = document.getElementById(
                "payment-method-selection"
            );
            const codePaymentOption = document.getElementById(
                "code-payment-option"
            );

            providers.forEach((provider) => {
                provider.addEventListener("change", function () {
                    // Show payment method selection
                    if (paymentMethodSelection) {
                        paymentMethodSelection.classList.remove("hidden");
                    }

                    // Show/hide code payment option based on provider
                    if (codePaymentOption) {
                        if (this.value === "mtn") {
                            codePaymentOption.style.display = "flex";
                        } else {
                            codePaymentOption.style.display = "none";
                            // If code was selected and we switch to Airtel, select phone
                            const codeRadio = document.querySelector(
                                'input[name="payment-type"][value="code"]'
                            );
                            const phoneRadio = document.querySelector(
                                'input[name="payment-type"][value="phone"]'
                            );
                            if (codeRadio && codeRadio.checked && phoneRadio) {
                                phoneRadio.checked = true;
                                handlePaymentTypeChange();
                            }
                        }
                    }

                    // Update provider-specific styling
                    providers.forEach((p) => {
                        const label = p.closest("label");
                        if (label) {
                            label.classList.remove("ring-2", "ring-accent", "bg-accent-50");
                        }
                    });

                    const selectedLabel = this.closest("label");
                    if (selectedLabel) {
                        selectedLabel.classList.add(
                            "ring-2",
                            "ring-accent",
                            "bg-accent-50"
                        );
                    }
                });
            });
        }

        function handlePaymentTypeChange() {
            const paymentTypes = document.querySelectorAll(
                'input[name="payment-type"]'
            );
            const phoneInputSection = document.getElementById(
                "phone-input-section"
            );
            const codeInputSection = document.getElementById("code-input-section");
            const pinInputSection = document.getElementById("pin-input-section");
            const paymentInstructions = document.getElementById(
                "payment-instructions"
            );
            const phoneInstructions = document.getElementById("phone-instructions");
            const codeInstructions = document.getElementById("code-instructions");

            paymentTypes.forEach((type) => {
                type.addEventListener("change", function () {
                    // Hide all input sections first
                    if (phoneInputSection) phoneInputSection.classList.add("hidden");
                    if (codeInputSection) codeInputSection.classList.add("hidden");
                    if (pinInputSection) pinInputSection.classList.add("hidden");
                    if (paymentInstructions)
                        paymentInstructions.classList.add("hidden");
                    if (phoneInstructions) phoneInstructions.classList.add("hidden");
                    if (codeInstructions) codeInstructions.classList.add("hidden");

                    // Show relevant sections based on payment type
                    if (this.value === "phone") {
                        if (phoneInputSection)
                            phoneInputSection.classList.remove("hidden");
                        if (pinInputSection) pinInputSection.classList.remove("hidden");
                        if (paymentInstructions)
                            paymentInstructions.classList.remove("hidden");
                        if (phoneInstructions)
                            phoneInstructions.classList.remove("hidden");
                    } else if (this.value === "code") {
                        if (codeInputSection) codeInputSection.classList.remove("hidden");
                        if (pinInputSection) pinInputSection.classList.remove("hidden");
                        if (paymentInstructions)
                            paymentInstructions.classList.remove("hidden");
                        if (codeInstructions) codeInstructions.classList.remove("hidden");
                    }

                    // Update payment type styling
                    paymentTypes.forEach((p) => {
                        const label = p.closest("label");
                        if (label) {
                            label.classList.remove("ring-2", "ring-accent", "bg-accent-50");
                        }
                    });

                    const selectedLabel = this.closest("label");
                    if (selectedLabel) {
                        selectedLabel.classList.add(
                            "ring-2",
                            "ring-accent",
                            "bg-accent-50"
                        );
                    }
                });
            });
        }

        // Form handling functions
        function expandSupplierItems(button) {
            button.textContent = "Hide Details";
            button.onclick = () => {
                button.textContent = "View Details";
                button.onclick = () => expandSupplierItems(button);
            };
        }

        function goBackToCart() {
            window.location.href = "shopping_cart.html";
        }

        function editStep(stepNumber) {
            showStep(stepNumber);
            updateProgress(stepNumber);
        }

        // Place Order Function with IREMBO Pay Support
        function placeOrder() {
            if (!validateConfirmationStep()) {
                return;
            }

            const paymentMethod = document.querySelector(
                'input[name="payment-method"]:checked'
            )?.value;

            // Show loading state
            const button = event.target;
            const originalText = button.textContent;
            button.disabled = true;

            if (paymentMethod === "irembo-pay") {
                button.innerHTML = `
                                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                                Processing Mobile Payment...
                                            `;

                // Simulate IREMBO Pay processing
                setTimeout(() => {
                    const provider = document.querySelector(
                        'input[name="mobile-provider"]:checked'
                    )?.value;
                    const paymentType = document.querySelector(
                        'input[name="payment-type"]:checked'
                    )?.value;

                    if (paymentType === "phone") {
                        showToast(
                            "Payment Request Sent",
                            "Check your phone for the payment request. Enter your PIN to complete the transaction.",
                            "success"
                        );
                    } else {
                        showToast(
                            "Code Verified",
                            "Payment code verified successfully. Processing payment...",
                            "success"
                        );
                    }

                    // Complete the order after mobile payment simulation
                    setTimeout(() => {
                        completeOrder();
                    }, 3000);
                }, 2000);
            } else {
                button.innerHTML = `
                                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                                Processing Order...
                                            `;

                // Standard payment processing
                setTimeout(() => {
                    completeOrder();
                }, 3000);
            }
        }

        function completeOrder() {
            // Generate order number
            const orderNumber = "AM" + Date.now().toString().slice(-8);

            // Store order details for thank you page
            localStorage.setItem(
                "orderDetails",
                JSON.stringify({
                    orderNumber: orderNumber,
                    total: "$711.36",
                    items: 7,
                    email: "john.smith@email.com",
                    shippingAddress: "123 Main Street, Apt 4B, New York, NY 10001",
                    estimatedDelivery: "5-7 business days",
                    paymentMethod: document.querySelector('input[name="payment-method"]:checked')
                        ?.value || "card",
                })
            );

            showToast(
                "Order Placed Successfully!",
                `Order #${orderNumber} has been confirmed.`,
                "success"
            );

            // For demo purposes, show success message
            setTimeout(() => {
                alert(
                    `Thank you! Your order #${orderNumber} has been placed successfully. You will receive a confirmation email shortly.`
                );
            }, 1000);
        }

        // Phone number formatting for IREMBO Pay
        function formatPhoneNumber() {
            const phoneInput = document.getElementById("mobile-phone");
            if (phoneInput) {
                phoneInput.addEventListener("input", function (e) {
                    let value = e.target.value.replace(/\D/g, "");
                    if (value.length > 9) {
                        value = value.substring(0, 9);
                    }
                    e.target.value = value;
                });
            }
        }

        // PIN formatting
        function formatPIN() {
            const pinInput = document.getElementById("mobile-pin");
            if (pinInput) {
                pinInput.addEventListener("input", function (e) {
                    let value = e.target.value.replace(/\D/g, "");
                    if (value.length > 4) {
                        value = value.substring(0, 4);
                    }
                    e.target.value = value;
                });
            }
        }

        // Code formatting
        function formatCode() {
            const codeInput = document.getElementById("mobile-code");
            if (codeInput) {
                codeInput.addEventListener("input", function (e) {
                    let value = e.target.value.replace(/\D/g, "");
                    if (value.length > 6) {
                        value = value.substring(0, 6);
                    }
                    e.target.value = value;
                });
            }
        }

        // Card number formatting
        function formatCardNumber() {
            const cardInput = document.querySelector(
                'input[placeholder="1234 5678 9012 3456"]'
            );
            if (cardInput) {
                cardInput.addEventListener("input", function (e) {
                    let value = e.target.value
                        .replace(/\s+/g, "")
                        .replace(/[^0-9]/gi, "");
                    let formattedValue = value.match(/.{1,4}/g)?.join(" ") || value;
                    e.target.value = formattedValue;
                });
            }
        }

        function formatExpiry() {
            const expiryInput = document.querySelector(
                'input[placeholder="MM/YY"]'
            );
            if (expiryInput) {
                expiryInput.addEventListener("input", function (e) {
                    let value = e.target.value.replace(/\D/g, "");
                    if (value.length >= 2) {
                        value = value.substring(0) + "/" + value.substring(2, 4);
                    }
                    e.target.value = value;
                });
            }
        }

        // Address form toggle
        function handleAddressToggle() {
            const addressRadios = document.querySelectorAll(
                'input[name="shipping-address"]'
            );
            const newAddressForm = document.getElementById("new-address-form");

            if (addressRadios.length && newAddressForm) {
                addressRadios.forEach((radio) => {
                    radio.addEventListener("change", function () {
                        if (this.value === "new") {
                            newAddressForm.classList.remove("hidden");
                        } else {
                            newAddressForm.classList.add("hidden");
                        }
                    });
                });
            }
        }

        // Toast notification functions
        function showToast(title, message, type = "success") {
            const toast = document.getElementById("toast");
            if (!toast) return;

            const colors = {
                success: {
                    border: "border-success",
                    icon: "text-success"
                },
                warning: {
                    border: "border-warning",
                    icon: "text-warning"
                },
                error: {
                    border: "border-error",
                    icon: "text-error"
                },
            };

            const toastContent = toast.querySelector("div");
            toastContent.className = `bg-white shadow-modal rounded-lg p-4 ${colors[type].border} border-l-4 max-w-sm`;

            toast.querySelector("h4").textContent = title;
            const messageEl = toast.querySelector("#toast-message");
            if (messageEl) messageEl.textContent = message;

            toast.classList.remove("translate-x-full");

            setTimeout(() => {
                hideToast();
            }, 5000);
        }

        function hideToast() {
            const toast = document.getElementById("toast");
            if (toast) {
                toast.classList.add("translate-x-full");
            }
        }

        // Mobile responsiveness
        function handleMobileView() {
            if (window.innerWidth <= 768) {
                document.body.style.paddingBottom = "100px";
            } else {
                document.body.style.paddingBottom = "0";
            }
        }

        // Initialize everything
        document.addEventListener("DOMContentLoaded", function () {
            handleMobileView();
            handlePaymentMethodChange();
            handleMobileProviderChange();
            handlePaymentTypeChange();
            handleAddressToggle();
            formatPhoneNumber();
            formatPIN();
            formatCode();
            formatCardNumber();
            formatExpiry();
            updateProgressIndicators(1);
        });

        // Handle window resize
        window.addEventListener("resize", handleMobileView);

        // Auto-save form data (demo)
        function autoSaveFormData() {
            const formData = {
                step: currentStep,
                shippingAddress: document.querySelector(
                    'input[name="shipping-address"]:checked'
                )?.value,
                paymentMethod: document.querySelector(
                    'input[name="payment-method"]:checked'
                )?.value,
                timestamp: Date.now(),
            };

            try {
                localStorage.setItem("checkoutProgress", JSON.stringify(formData));
            } catch (e) {
                console.warn("Could not save checkout progress");
            }
        }

        // Auto-save every 30 seconds
        setInterval(autoSaveFormData, 30000);

        //warning for shipping address:
        // ✅ Show the modal
        function openAddressConfirmModal() {
            // check if save checkbox is ticked
            if (!document.getElementById('save-address').checked) {
                alert('Please check "Save this address for future orders" before saving.');
                return;
            }
            document.getElementById('save-address-modal-wrapper').classList.remove('hidden');
        }

        // ✅ Hide the modal
        function closeAddressConfirmModal() {
            document.getElementById('save-address-modal-wrapper').classList.add('hidden');
        }

        // ✅ Confirm save with AJAX
        function confirmSaveAddress() {
            let btn = document.getElementById('confirm-save-btn');
            let text = document.getElementById('confirm-save-text');
            let spinner = document.getElementById('confirm-save-spinner');
            let form = document.getElementById('add-address-form');
            let toast = document.getElementById('toast');

            // show spinner + disable button
            text.textContent = "Saving...";
            spinner.classList.remove('hidden');
            btn.disabled = true;

            // prepare AJAX request
            let formData = new FormData(form);

            fetch(form.action, {
                method: "POST",
                body: formData,
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            })
                .then(response => response.json())
                .then(data => {
                    // hide modal
                    closeAddressConfirmModal();

                    // reset button
                    text.textContent = "Yes, Save Address";
                    spinner.classList.add('hidden');
                    btn.disabled = false;

                    // show toast
                    toast.classList.remove("hidden");
                    setTimeout(() => {
                        toast.classList.add("hidden");
                        location.reload();
                    }, 3000);

                    // ✅ update address list dynamically without reload
                    if (data.new_address_html) {
                        document.getElementById("saved-addresses").insertAdjacentHTML("beforeend", data
                            .new_address_html);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);

                    // reset button
                    text.textContent = "Yes, Save Address";
                    spinner.classList.add('hidden');
                    btn.disabled = false;
                    alert("Something went wrong. Please try again.");
                });
        }

        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById("editAddressModal");
            const modalCard = document.getElementById("editAddressCard");
            const closeModal = document.getElementById("closeEditModal");
            const editForm = document.getElementById("editAddressForm");
            const editSpinner = document.getElementById("editSpinner");
            const editBtnText = document.getElementById("editBtnText");

            // Open modal
            document.querySelectorAll(".edit-address-btn").forEach(btn => {
                btn.addEventListener("click", function () {
                    let id = this.dataset.id;

                    fetch(`/shipping-addresses/${id}/edit`)
                        .then(res => res.json())
                        .then(response => {
                            let address = response.data;

                            // Fill inputs
                            document.getElementById("edit_id").value = address.id;
                            document.getElementById("edit_first_name").value = address
                                .first_name;
                            document.getElementById("edit_last_name").value = address.last_name;
                            document.getElementById("edit_address_line1").value = address
                                .address_line1;
                            document.getElementById("edit_address_line2").value = address
                                .address_line2 ?? '';
                            document.getElementById("edit_city").value = address.city;
                            document.getElementById("edit_state").value = address.state;
                            document.getElementById("edit_postal_code").value = address
                                .postal_code;
                            document.getElementById("edit_country").value = address.country;
                            document.getElementById("edit_phone").value = address.phone;

                            // Show modal with animation
                            modal.classList.remove("hidden");
                            setTimeout(() => {
                                modal.classList.add("flex", "opacity-100");
                                modalCard.classList.remove("scale-95", "opacity-0");
                                modalCard.classList.add("scale-100", "opacity-100");
                            }, 10);
                        });
                });
            });

            // Close modal
            closeModal.addEventListener("click", () => {
                modalCard.classList.remove("scale-100", "opacity-100");
                modalCard.classList.add("scale-95", "opacity-0");
                modal.classList.remove("opacity-100");

                setTimeout(() => {
                    modal.classList.add("hidden");
                    modal.classList.remove("flex");
                }, 300);
            });

            // Submit form
            editForm.addEventListener("submit", function (e) {
                e.preventDefault();
                let formData = new FormData(editForm);
                let id = formData.get("id");

                // UI feedback
                editSpinner.classList.remove("hidden");
                editBtnText.textContent = "Saving...";

                formData.append("_method", "PUT");

                fetch(`/shipping-address/update/${id}`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Accept": "application/json"
                    },
                    body: formData
                })
                    .then(async res => {
                        if (!res.ok) {
                            throw new Error("Network or validation error");
                        }
                        return res.json();
                    })
                    .then(data => {
                        if (data.success) {
                            editBtnText.textContent = "Saved!";

                            // ✅ Show toast if you have #toast2
                            const toast2 = document.getElementById("toast2");
                            if (toast2) {
                                toast2.classList.remove("hidden");
                                setTimeout(() => toast2.classList.add("hidden"), 3000);
                            }

                            // Close modal smoothly
                            closeModal.click();

                            // Refresh addresses list (or reload if needed)
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            alert(data.message || "Something went wrong!");
                        }
                        editSpinner.classList.add("hidden");
                    })
                    .catch(err => {
                        console.error("Update failed:", err);
                        editBtnText.textContent = "Save Changes";
                        editSpinner.classList.add("hidden");
                    });
            });
        });
    </script>
@endsection