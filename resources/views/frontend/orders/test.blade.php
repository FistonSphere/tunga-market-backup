  <!-- Breadcrumb Navigation -->
    <section class="bg-surface py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="homepage.html" class="text-secondary-600 hover:text-primary transition-fast">Home</a>
                <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <a href="order_tracking_center.html" class="text-secondary-600 hover:text-primary transition-fast">Order
                    Tracking</a>
                <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-primary font-semibold" id="breadcrumb-order-number">Order {{ $order->order_no }}</span>
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
                                #AM2025-789456</h1>
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
                                <span>Ordered on <span id="header-order-date" class="font-semibold">January 15,
                                        2025</span></span>
                            </div>
                            <div class="flex items-center space-x-2 mt-2 sm:mt-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                </svg>
                                <span>Total: <span id="header-order-total"
                                        class="font-bold text-accent text-lg">$2,847.50</span></span>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-3 sm:space-y-0 sm:space-x-4">
                        <span id="header-status-badge"
                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-success-100 text-success-800">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Delivered
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
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                Order Summary
                            </h2>
                            <button onclick="toggleSection('order-summary-content')"
                                class="text-secondary-600 hover:text-accent transition-fast">
                                <svg class="w-5 h-5 transform transition-transform duration-200" id="order-summary-icon"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>

                        <div id="order-summary-content" class="space-y-4">
                            <div id="order-items-container" class="space-y-4">
                                <!-- Items will be populated by JavaScript -->
                            </div>

                            <!-- Order Totals -->
                            <div class="border-t border-border pt-4">
                                <div class="space-y-2">
                                    <div class="flex justify-between text-secondary-600">
                                        <span>Subtotal:</span>
                                        <span id="subtotal">$2,847.50</span>
                                    </div>
                                    <div class="flex justify-between text-secondary-600">
                                        <span>Shipping:</span>
                                        <span id="shipping-cost">Free</span>
                                    </div>
                                    <div class="flex justify-between text-secondary-600">
                                        <span>Tax:</span>
                                        <span id="tax-amount">$0.00</span>
                                    </div>
                                    <div
                                        class="flex justify-between text-lg font-bold text-primary border-t border-border pt-2">
                                        <span>Total:</span>
                                        <span id="final-total">$2,847.50</span>
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
                            <!-- Tracking Timeline -->
                            <div>
                                <h3 class="font-semibold text-primary mb-4">Delivery Timeline</h3>
                                <div id="tracking-timeline" class="relative pl-8">
                                    <!-- Timeline will be populated by JavaScript -->
                                </div>
                            </div>

                            <!-- Live GPS Tracking -->
                            <div id="gps-section" class="hidden">
                                <h3 class="font-semibold text-primary mb-4">Live GPS Tracking</h3>
                                <div class="bg-secondary-50 rounded-lg p-6">
                                    <div class="flex items-center space-x-4 mb-4">
                                        <div class="w-12 h-12 bg-accent rounded-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white animate-pulse" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-primary">Package In Transit</h4>
                                            <p class="text-secondary-600">Last updated: 2 hours ago</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <span class="text-secondary-600">Current Location:</span>
                                            <div class="font-semibold text-primary">Distribution Center - Los Angeles, CA
                                            </div>
                                        </div>
                                        <div>
                                            <span class="text-secondary-600">Next Destination:</span>
                                            <div class="font-semibold text-primary">Local Delivery Hub</div>
                                        </div>
                                        <div>
                                            <span class="text-secondary-600">Estimated Delivery:</span>
                                            <div class="font-semibold text-accent">Tomorrow 2:00 PM - 6:00 PM</div>
                                        </div>
                                        <div>
                                            <span class="text-secondary-600">Tracking Number:</span>
                                            <div class="font-semibold text-primary">TRK789456123</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delivery Address -->
                            <div class="bg-surface rounded-lg p-4">
                                <h3 class="font-semibold text-primary mb-3">Delivery Address</h3>
                                <div class="text-secondary-600" id="delivery-address">
                                    <div class="font-medium text-primary">John Smith</div>
                                    <div>123 Technology Blvd</div>
                                    <div>San Francisco, CA 94105</div>
                                    <div>United States</div>
                                    <div>Phone: +1 (555) 123-4567</div>
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
                                    <div>
                                        <label class="text-sm text-secondary-600">Payment Method</label>
                                        <div class="flex items-center space-x-3 mt-1">
                                            <svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M21 4H3c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 12H3V8h18v8z" />
                                            </svg>
                                            <div>
                                                <div class="font-semibold text-primary" id="payment-method-display">••••
                                                    •••• •••• 4532</div>
                                                <div class="text-sm text-secondary-600">Visa ending in 4532</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="text-sm text-secondary-600">Transaction ID</label>
                                        <div class="font-medium text-primary" id="transaction-id-display">TXN-789456123
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm text-secondary-600">Payment Status</label>
                                        <div class="flex items-center space-x-2 mt-1">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-success-100 text-success-800">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                                Paid
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="text-sm text-secondary-600">Payment Date</label>
                                        <div class="font-medium text-primary" id="payment-date">January 15, 2025 at 2:30
                                            PM</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Billing Address -->
                            <div class="border-t border-border pt-4">
                                <h3 class="font-semibold text-primary mb-3">Billing Address</h3>
                                <div class="text-secondary-600" id="billing-address">
                                    <div class="font-medium text-primary">John Smith</div>
                                    <div>123 Technology Blvd</div>
                                    <div>San Francisco, CA 94105</div>
                                    <div>United States</div>
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

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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

                            <button onclick="downloadShippingLabel()"
                                class="flex flex-col items-center p-4 border-2 border-dashed border-border rounded-lg hover:border-accent hover:bg-accent-50 transition-fast group">
                                <svg class="w-8 h-8 text-secondary-400 group-hover:text-accent mb-2" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <span class="font-medium text-primary group-hover:text-accent">Shipping Label</span>
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
                                    <h4 class="font-semibold text-primary" id="supplier-name-display">TechSound
                                        Electronics</h4>
                                    <p class="text-secondary-600" id="supplier-location-display">Shenzhen, China</p>
                                    <div class="flex items-center mt-2">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-warning fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <span class="text-sm font-medium text-secondary-600 ml-1">4.8 (1,247
                                                reviews)</span>
                                        </div>
                                    </div>
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
                                    <button onclick="contactSupplier()" class="flex-1 btn-secondary text-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        Contact
                                    </button>
                                    <button onclick="viewSupplierProfile()"
                                        class="text-accent hover:text-accent-600 font-semibold text-sm px-4 py-2 border border-accent rounded-lg transition-fast">
                                        View Profile
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

                                <button onclick="initiateReturn()"
                                    class="w-full btn-secondary flex items-center justify-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                    </svg>
                                    <span>Return Items</span>
                                </button>

                                <button onclick="reportIssue()"
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

    <!-- Bottom Navigation for Mobile -->
    <div id="mobile-bottom-nav" class="fixed bottom-0 left-0 right-0 bg-white border-t border-border md:hidden z-40">
        <div class="flex items-center justify-around py-2">
            <button onclick="window.location.href='order_tracking_center.html'"
                class="flex flex-col items-center p-2 text-primary hover:text-accent transition-fast">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="text-xs font-semibold">Back</span>
            </button>

            <button onclick="reorderItems()"
                class="flex flex-col items-center p-2 text-secondary-600 hover:text-primary transition-fast">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <span class="text-xs">Reorder</span>
            </button>

            <button onclick="contactSupport()"
                class="flex flex-col items-center p-2 text-secondary-600 hover:text-primary transition-fast">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <span class="text-xs">Support</span>
            </button>

            <button onclick="downloadInvoice()"
                class="flex flex-col items-center p-2 text-secondary-600 hover:text-primary transition-fast">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="text-xs">Invoice</span>
            </button>

            <button onclick="contactSupplier()"
                class="flex flex-col items-center p-2 text-secondary-600 hover:text-primary transition-fast">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-xs">Supplier</span>
            </button>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast-notification"
        class="fixed top-4 right-4 transform translate-x-full transition-transform duration-300 z-50">
        <div class="bg-white shadow-modal rounded-lg p-4 border-l-4 border-success max-w-sm">
            <div class="flex items-start space-x-3">
                <svg class="w-5 h-5 text-success flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <h4 class="font-semibold text-primary" id="toast-title">Success!</h4>
                    <p class="text-body-sm text-secondary-600 mt-1" id="toast-message">Action completed successfully.</p>
                </div>
                <button onclick="hideToast()" class="text-secondary-400 hover:text-secondary-600 transition-fast">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
