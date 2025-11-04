@extends('layouts.app')

@section('content')
    <!-- Order Confirmation Hero -->
    <section class="bg-gradient-to-br from-success-50 to-accent-50 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="w-20 h-20 bg-success rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-primary mb-4">Thank You for Your Order!</h1>
            <p class="text-xl text-secondary-600 mb-8">Your order has been successfully placed and is being processed</p>

            <!-- Order Summary Card -->
            <div class="card max-w-2xl mx-auto text-left">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-semibold text-primary mb-4">Order Details</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Order Number:</span>
                                <span class="font-semibold text-primary">#AM2025-789456</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Order Date:</span>
                                <span class="font-semibold">Jan 26, 2025</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Total Amount:</span>
                                <span class="font-semibold text-accent text-lg">$2,847.50</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Payment Method:</span>
                                <span class="font-semibold">•••• 4532</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-primary mb-4">Delivery Information</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Estimated Delivery:</span>
                                <span class="font-semibold text-success">Feb 2-5, 2025</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Shipping Method:</span>
                                <span class="font-semibold">Express International</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Tracking ID:</span>
                                <span class="font-semibold text-primary">TRK789456123</span>
                            </div>
                        </div>
                        <button class="btn-primary w-full mt-4" onclick="downloadInvoice()">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <div class="space-y-4">
                <!-- Item 1 -->
                <div class="card">
                    <div class="flex items-center space-x-4">
                        <img src="https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?q=80&w=2679&auto=format&fit=crop"
                            alt="Wireless Earbuds Pro" class="w-20 h-20 rounded-lg object-cover" loading="lazy" />
                        <div class="flex-1">
                            <h3 class="font-semibold text-primary">Premium Wireless Earbuds Pro</h3>
                            <p class="text-secondary-600 mb-2">Supplier: TechSound Electronics</p>
                            <div class="flex items-center space-x-4">
                                <span class="text-secondary-600">Qty: 50</span>
                                <span class="text-secondary-600">Unit Price: $45.50</span>
                                <span class="font-semibold text-accent">$2,275.00</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="bg-warning-100 text-warning-700 px-3 py-1 rounded-full text-sm font-semibold mb-2">
                                Processing
                            </div>
                            <button class="text-accent hover:text-accent-600 text-sm font-semibold">
                                Track This Item
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="card">
                    <div class="flex items-center space-x-4">
                        <img src="https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                            alt="Smart Home Hub" class="w-20 h-20 rounded-lg object-cover" loading="lazy" />
                        <div class="flex-1">
                            <h3 class="font-semibold text-primary">Smart Home Hub Controller</h3>
                            <p class="text-secondary-600 mb-2">Supplier: HomeAutomation Co.</p>
                            <div class="flex items-center space-x-4">
                                <span class="text-secondary-600">Qty: 25</span>
                                <span class="text-secondary-600">Unit Price: $22.90</span>
                                <span class="font-semibold text-accent">$572.50</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-sm font-semibold mb-2">
                                Packaging
                            </div>
                            <button class="text-accent hover:text-accent-600 text-sm font-semibold">
                                Track This Item
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection