@extends('layouts.app')
@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-primary-50 to-accent-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-primary mb-4">Order Tracking Center</h1>
                <p class="text-lg text-secondary-600 max-w-2xl mx-auto">
                    Track your orders with real-time updates, manage delivery preferences, and access order history
                </p>
            </div>
        </div>
    </section>

    <!-- Main Tracking Interface -->
    <section class="py-8 w-full overflow-x-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Panel - Order History Table -->
                <div class="space-y-6">
                    <!-- Filters and Search -->
                    <div class="card">
                        <h3 class="text-xl font-semibold text-primary mb-4">Order History</h3>

                        <!-- Quick Filters -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            <a href="{{ route('order.tracking', ['status' => 'all']) }}"
                                class="filter-btn px-3 py-1 rounded-full text-sm font-medium {{ $status == 'all' || !$status ? 'bg-accent text-white' : 'bg-secondary-100 text-secondary-600 hover:bg-secondary-200' }}">
                                All Orders
                            </a>

                            <a href="{{ route('order.tracking', ['status' => 'Processing']) }}"
                                class="filter-btn px-3 py-1 rounded-full text-sm font-medium {{ $status == 'Processing' ? 'bg-accent text-white' : 'bg-secondary-100 text-secondary-600 hover:bg-secondary-200' }}">
                                Processing
                            </a>

                            <a href="{{ route('order.tracking', ['status' => 'Delivered']) }}"
                                class="filter-btn px-3 py-1 rounded-full text-sm font-medium {{ $status == 'Delivered' ? 'bg-accent text-white' : 'bg-secondary-100 text-secondary-600 hover:bg-secondary-200' }}">
                                Delivered
                            </a>

                            <a href="{{ route('order.tracking', ['status' => 'Canceled']) }}"
                                class="filter-btn px-3 py-1 rounded-full text-sm font-medium {{ $status == 'Canceled' ? 'bg-accent text-white' : 'bg-secondary-100 text-secondary-600 hover:bg-secondary-200' }}">
                                Canceled
                            </a>
                        </div>


                        <!-- Date Range Filter -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-primary mb-1">From Date</label>
                                <input type="date" class="input-field" id="date-from"
                                    value="{{ request('from_date') }}" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-primary mb-1">To Date</label>
                                <input type="date" class="input-field" id="date-to" value="{{ request('to_date') }}" />
                            </div>
                            <div class="flex items-end">
                                <button onclick="applyDateFilter()" class="btn-secondary w-full">Apply Filter</button>
                            </div>
                        </div>
                    </div>


                    <!-- Orders Table -->
                    <div class="card overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-surface">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-primary">Order #</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-primary">Date</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-primary">Brand</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-primary">Total</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-primary">Status</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-primary">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-border">
                                    @forelse($orders as $order)
                                        <tr class="order-row hover:bg-surface transition-fast cursor-pointer"
                                            data-status="{{ strtolower($order->status) }}"
                                            data-date="{{ $order->created_at->format('Y-m-d') }}">
                                            {{-- Order # --}}
                                            <td class="px-4 py-4">
                                                <div class="flex flex-wrap items-center gap-2">
                                                    <span class="font-semibold text-primary">#{{ $order->order_no }}</span>
                                                    <button
                                                        onclick="event.stopPropagation(); copyReferenceNumber('{{ $order->order_no }}')"
                                                        class="text-secondary-400 hover:text-accent transition-fast p-1"
                                                        title="Copy Reference">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>

                                            {{-- Date --}}
                                            <td class="px-4 py-4 text-sm text-secondary-600">
                                                {{ $order->created_at->format('M d, Y') }}
                                            </td>

                                            {{-- Supplier --}}
                                            <td class="px-4 py-4 text-sm text-secondary-600">
                                                {{ $order->first()->product->brand->name ?? 'Tunga Market Inc.' }}

                                            </td>

                                            {{-- Total --}}
                                            <td class="px-4 py-4 text-sm font-semibold text-primary">
                                                {{ number_format($order->price * $order->quantity) }} Rwf
                                            </td>

                                            {{-- Status --}}
                                            @php
                                                $order = $order->order;
                                                $status = strtolower($order->status ?? '');
                                                $badgeClass = '';
                                                $statusText = ucfirst($order->status ?? 'Unknown');

                                                switch ($status) {
                                                    case 'processing':
                                                        $badgeClass = 'bg-warning-100 text-warning-800';
                                                        break;
                                                    case 'delivered':
                                                    case 'completed':
                                                        $badgeClass = 'bg-success-100 text-success-800';
                                                        break;
                                                    case 'canceled':
                                                        $badgeClass = 'bg-error-100 text-error-800';
                                                        break;
                                                    default:
                                                        $badgeClass = 'bg-secondary-100 text-secondary-800';
                                                        break;
                                                }
                                            @endphp

                                            <td class="px-4 py-4">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClass }}">
                                                    {{ $statusText }}
                                                </span>

                                            </td>

                                            {{-- Action --}}
                                            <td class="px-4 py-4">
                                                <button
                                                    onclick="event.stopPropagation(); window.location='{{ route('orders.show', ['order' => $order->id]) }}'"
                                                    class="text-accent hover:text-accent-600 text-sm font-semibold">
                                                    View Details
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-4 py-4 text-center text-sm text-secondary-600">
                                                You have no orders yet.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if ($orders->hasPages())
                            <div class="flex items-center justify-between px-4 py-3 border-t border-border">
                                <div class="text-sm text-secondary-600">
                                    Showing
                                    {{ $orders->firstItem() }} - {{ $orders->lastItem() }}
                                    of {{ $orders->total() }} orders
                                </div>

                                <div class="flex flex-wrap items-center gap-2">
                                    {{-- Previous Page --}}
                                    @if ($orders->onFirstPage())
                                        <span
                                            class="px-3 py-1 text-sm border border-border rounded text-gray-400 cursor-not-allowed">Previous</span>
                                    @else
                                        <a href="{{ $orders->previousPageUrl() }}"
                                            class="px-3 py-1 text-sm border border-border rounded hover:bg-surface transition-fast">
                                            Previous
                                        </a>
                                    @endif

                                    {{-- Page Numbers --}}
                                    @foreach ($orders->links()->elements[0] ?? [] as $page => $url)
                                        @if ($page == $orders->currentPage())
                                            <span
                                                class="px-3 py-1 text-sm bg-accent text-white rounded">{{ $page }}</span>
                                        @else
                                            <a href="{{ $url }}"
                                                class="px-3 py-1 text-sm border border-border rounded hover:bg-surface transition-fast">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    @endforeach

                                    {{-- Next Page --}}
                                    @if ($orders->hasMorePages())
                                        <a href="{{ $orders->nextPageUrl() }}"
                                            class="px-3 py-1 text-sm border border-border rounded hover:bg-surface transition-fast">
                                            Next
                                        </a>
                                    @else
                                        <span
                                            class="px-3 py-1 text-sm border border-border rounded text-gray-400 cursor-not-allowed">Next</span>
                                    @endif
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                <!-- Right Panel - Search and Order Details -->
                <div class="space-y-6">
                    <!-- Order Search Box -->
                    <div class="card">
                        <h3 class="text-xl font-semibold text-primary mb-4">Track Your Order</h3>

                        <div class="space-y-4">
                            <!-- Search Input -->
                            <div class="relative w-full">
                                <input type="text" id="order-search" class="input-field pr-20 w-full"
                                    placeholder="Enter order reference number (e.g., AM2025-789456)"
                                    onpaste="handlePaste(event)" />
                                <button onclick="searchOrder()"
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 btn-primary px-4 py-2">
                                    Search
                                </button>
                            </div>

                            <!-- Alternative Search Methods -->
                            <div class="flex flex-wrap gap-2">
                                <button onclick="scanBarcode()"
                                    class="flex flex-wrap items-center gap-2 px-3 py-2 border border-border rounded-lg hover:bg-surface transition-fast text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V4a1 1 0 00-1-1H5a1 1 0 00-1 1v3a1 1 0 001 1zm12 0h2a1 1 0 001-1V4a1 1 0 00-1-1h-2a1 1 0 00-1 1v3a1 1 0 001 1zM5 20h2a1 1 0 001-1v-3a1 1 0 00-1-1H5a1 1 0 00-1 1v3a1 1 0 001 1z" />
                                    </svg>
                                    <span>Scan Barcode</span>
                                </button>
                                <button onclick="useVoiceInput()"
                                    class="flex flex-wrap items-center gap-2 px-3 py-2 border border-border rounded-lg hover:bg-surface transition-fast text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                                    </svg>
                                    <span>Voice Input</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Order Details Display -->
                    <div id="order-details" class="card hidden">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-semibold text-primary">Order Details</h3>
                            <button onclick="clearOrderDetails()"
                                class="text-secondary-600 hover:text-error transition-fast">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Order Summary -->
                        <div id="order-summary" class="space-y-6">
                            <!-- Order Header -->
                            <div class="bg-surface rounded-lg p-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-sm text-secondary-600">Order Number</label>
                                        <div class="font-semibold text-primary" id="detail-order-number">#AM2025-789456
                                        </div>
                                    </div>
                                    <div>
                                        <label class="text-sm text-secondary-600">Order Date</label>
                                        <div class="font-semibold text-primary" id="detail-order-date">January 15, 2025
                                        </div>
                                    </div>
                                    <div>
                                        <label class="text-sm text-secondary-600">Total Amount</label>
                                        <div class="font-semibold text-accent text-lg" id="detail-order-total">$2,847.50
                                        </div>
                                    </div>
                                    <div>
                                        <label class="text-sm text-secondary-600">Status</label>
                                        <span id="detail-order-status"
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-success-100 text-success-800">
                                            Delivered
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Items -->
                            <div>
                                <h4 class="font-semibold text-primary mb-3">Items Ordered</h4>
                                <div id="order-items" class="space-y-3">
                                    <!-- Item will be populated by JavaScript -->
                                </div>
                            </div>

                            <!-- Shipping Timeline -->
                            <div>
                                <h4 class="font-semibold text-primary mb-4">Shipping Timeline</h4>
                                <div id="shipping-timeline" class="relative">
                                    <!-- Timeline will be populated by JavaScript -->
                                </div>
                            </div>

                            <!-- Payment Details -->
                            <div class="bg-surface rounded-lg p-4">
                                <h4 class="font-semibold text-primary mb-3">Payment Information</h4>
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <label class="text-secondary-600">Payment Method</label>
                                        <div class="font-medium" id="payment-method">•••• •••• •••• 4532</div>
                                    </div>
                                    <div>
                                        <label class="text-secondary-600">Transaction ID</label>
                                        <div class="font-medium" id="transaction-id">TXN-789456123</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Supplier Contact -->
                            <div class="bg-surface rounded-lg p-4">
                                <h4 class="font-semibold text-primary mb-3">Supplier Information</h4>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-medium" id="supplier-name">TechSound Electronics</div>
                                        <div class="text-sm text-secondary-600" id="supplier-location">Shenzhen, China
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button onclick="contactSupplier()" class="btn-secondary px-3 py-2 text-sm">
                                            Contact Supplier
                                        </button>
                                        <button onclick="downloadInvoice()"
                                            class="text-accent hover:text-accent-600 text-sm font-semibold">
                                            Download Invoice
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="flex flex-wrap gap-3">
                                <button onclick="reorderItems()" class="btn-primary flex flex-wrap items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    <span>Reorder</span>
                                </button>
                                <button onclick="initiateReturn()"
                                    class="btn-secondary flex flex-wrap items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                    </svg>
                                    <span>Return Items</span>
                                </button>
                                <button onclick="contactSupport()"
                                    class="text-accent hover:text-accent-600 font-semibold px-4 py-2">
                                    Customer Support
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- GPS Tracking Map (when available) -->
                    <div id="gps-tracking" class="card hidden">
                        <h4 class="font-semibold text-primary mb-4">Live GPS Tracking</h4>
                        <div class="bg-secondary-100 rounded-lg h-64 flex items-center justify-center mb-4">
                            <div class="text-center">
                                <svg class="w-16 h-16 text-accent mx-auto mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <p class="text-secondary-600">Live tracking available once shipped</p>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Current Location:</span>
                                <span class="font-semibold text-primary" id="current-location">In Transit</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Next Stop:</span>
                                <span class="font-semibold text-primary" id="next-stop">Distribution Center</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">ETA:</span>
                                <span class="font-semibold text-accent" id="eta">Tomorrow 2:00 PM</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Order Tracking Center Management
        class OrderTrackingManager {
            constructor() {
                this.orders = this.generateSampleOrders();
                this.selectedOrder = null;
                this.initializePage();
            }

            generateSampleOrders() {
                return {
                    'AM2025-789456': {
                        orderNumber: 'AM2025-789456',
                        date: 'January 15, 2025',
                        supplier: 'TechSound Electronics',
                        total: '$2,847.50',
                        status: 'delivered',
                        statusText: 'Delivered',
                        items: [{
                                name: 'Premium Wireless Earbuds Pro',
                                image: 'https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?q=80&w=2679&auto=format&fit=crop',
                                quantity: 50,
                                price: '$45.50',
                                total: '$2,275.00'
                            },
                            {
                                name: 'Smart Home Hub Controller',
                                image: 'https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                                quantity: 25,
                                price: '$22.90',
                                total: '$572.50'
                            }
                        ],
                        timeline: [{
                                status: 'Order Confirmed',
                                date: 'Jan 15, 2025 at 2:30 PM',
                                completed: true
                            },
                            {
                                status: 'Processing',
                                date: 'Jan 15, 2025 at 4:15 PM',
                                completed: true
                            },
                            {
                                status: 'Shipped',
                                date: 'Jan 16, 2025 at 10:00 AM',
                                completed: true
                            },
                            {
                                status: 'Out for Delivery',
                                date: 'Jan 18, 2025 at 8:30 AM',
                                completed: true
                            },
                            {
                                status: 'Delivered',
                                date: 'Jan 18, 2025 at 2:45 PM',
                                completed: true
                            }
                        ],
                        paymentMethod: '•••• •••• •••• 4532',
                        transactionId: 'TXN-789456123',
                        supplierLocation: 'Shenzhen, China'
                    },
                    'AM2025-456789': {
                        orderNumber: 'AM2025-456789',
                        date: 'January 20, 2025',
                        supplier: 'GlobalTech Solutions',
                        total: '$1,245.75',
                        status: 'shipped',
                        statusText: 'Shipped',
                        items: [{
                            name: 'Bluetooth Speaker System',
                            image: 'https://images.unsplash.com/photo-1583394838336-acd977736f90?q=80&w=2684&auto=format&fit=crop',
                            quantity: 30,
                            price: '$41.53',
                            total: '$1,245.75'
                        }],
                        timeline: [{
                                status: 'Order Confirmed',
                                date: 'Jan 20, 2025 at 1:15 PM',
                                completed: true
                            },
                            {
                                status: 'Processing',
                                date: 'Jan 20, 2025 at 3:30 PM',
                                completed: true
                            },
                            {
                                status: 'Shipped',
                                date: 'Jan 22, 2025 at 9:45 AM',
                                completed: true
                            },
                            {
                                status: 'Out for Delivery',
                                date: 'Expected Jan 26, 2025',
                                completed: false
                            },
                            {
                                status: 'Delivered',
                                date: 'Expected Jan 27, 2025',
                                completed: false
                            }
                        ],
                        paymentMethod: '•••• •••• •••• 7890',
                        transactionId: 'TXN-456789012',
                        supplierLocation: 'Guangzhou, China'
                    },
                    'AM2025-987654': {
                        orderNumber: 'AM2025-987654',
                        date: 'January 24, 2025',
                        supplier: 'SmartHome Innovations',
                        total: '$892.30',
                        status: 'processing',
                        statusText: 'Processing',
                        items: [{
                            name: 'Smart Security Camera Set',
                            image: 'https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                            quantity: 15,
                            price: '$59.49',
                            total: '$892.30'
                        }],
                        timeline: [{
                                status: 'Order Confirmed',
                                date: 'Jan 24, 2025 at 11:20 AM',
                                completed: true
                            },
                            {
                                status: 'Processing',
                                date: 'In Progress',
                                completed: false
                            },
                            {
                                status: 'Shipped',
                                date: 'Expected Jan 26, 2025',
                                completed: false
                            },
                            {
                                status: 'Out for Delivery',
                                date: 'Expected Jan 28, 2025',
                                completed: false
                            },
                            {
                                status: 'Delivered',
                                date: 'Expected Jan 30, 2025',
                                completed: false
                            }
                        ],
                        paymentMethod: '•••• •••• •••• 1234',
                        transactionId: 'TXN-987654321',
                        supplierLocation: 'Shenzhen, China'
                    }
                };
            }

            initializePage() {
                this.updateCounts();
                this.handleMobileView();
                this.setupEventListeners();
            }

            updateCounts() {
                // Update header counts
                // const wishlistCount = this.getStoredCount('wishlistCount', 12);
                // const cartCount = this.getStoredCount('cartCount', 7);

                // document.getElementById('wishlist-count').textContent = wishlistCount;
                // document.getElementById('cart-count').textContent = cartCount;
            }

            getStoredCount(key, defaultValue = 0) {
                try {
                    const stored = localStorage.getItem(key);
                    return stored ? parseInt(stored) : defaultValue;
                } catch (e) {
                    return defaultValue;
                }
            }

            setupEventListeners() {
                // Handle paste event with auto-formatting
                document.getElementById('order-search').addEventListener('paste', this.handlePaste.bind(this));

                // Handle Enter key for search
                document.getElementById('order-search').addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        this.searchOrder();
                    }
                });
            }

            handlePaste(event) {
                setTimeout(() => {
                    const input = event.target;
                    let value = input.value.trim().toUpperCase();

                    // Auto-format reference number
                    if (value && !value.startsWith('AM')) {
                        value = 'AM2025-' + value.replace(/[^0-9]/g, '');
                    }

                    input.value = value;

                    // Auto-search if valid format
                    if (this.isValidOrderNumber(value)) {
                        setTimeout(() => this.searchOrder(), 500);
                    }
                }, 10);
            }

            isValidOrderNumber(orderNumber) {
                return /^AM2025-\d{6}$/.test(orderNumber);
            }

            searchOrder() {
                const searchInput = document.getElementById('order-search');
                const orderNumber = searchInput.value.trim().toUpperCase();

                if (!orderNumber) {
                    this.showToast('Enter Order Number', 'Please enter an order reference number', 'warning');
                    return;
                }

                if (!this.isValidOrderNumber(orderNumber)) {
                    this.showToast('Invalid Format', 'Please enter a valid order number (e.g., AM2025-789456)',
                        'error');
                    return;
                }

                if (this.orders[orderNumber]) {
                    this.displayOrderDetails(orderNumber);
                    this.highlightOrderInTable(orderNumber);
                    this.showToast('Order Found', 'Order details loaded successfully');
                } else {
                    this.showToast('Order Not Found', 'No order found with this reference number', 'error');
                }
            }

            selectOrder(orderNumber) {
                // Update search input
                document.getElementById('order-search').value = orderNumber;
                this.displayOrderDetails(orderNumber);
                this.highlightOrderInTable(orderNumber);
            }

            displayOrderDetails(orderNumber) {
                const order = this.orders[orderNumber];
                if (!order) return;

                this.selectedOrder = order;

                // Update order summary
                document.getElementById('detail-order-number').textContent = order.orderNumber;
                document.getElementById('detail-order-date').textContent = order.date;
                document.getElementById('detail-order-total').textContent = order.total;
                document.getElementById('supplier-name').textContent = order.supplier;
                document.getElementById('supplier-location').textContent = order.supplierLocation;
                document.getElementById('payment-method').textContent = order.paymentMethod;
                document.getElementById('transaction-id').textContent = order.transactionId;

                // Update status badge
                const statusElement = document.getElementById('detail-order-status');
                statusElement.className = this.getStatusClass(order.status);
                statusElement.textContent = order.statusText;

                // Populate order items
                this.populateOrderItems(order.items);

                // Populate shipping timeline
                this.populateShippingTimeline(order.timeline);

                // Show order details
                document.getElementById('order-details').classList.remove('hidden');

                // Show GPS tracking for shipped orders
                if (order.status === 'shipped') {
                    document.getElementById('gps-tracking').classList.remove('hidden');
                }

                // Scroll to details on mobile
                if (window.innerWidth <= 768) {
                    document.getElementById('order-details').scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }

            populateOrderItems(items) {
                const container = document.getElementById('order-items');
                container.innerHTML = items.map(item => `
                    <div class="flex items-center space-x-4 p-3 border border-border rounded-lg">
                        <img src="${item.image}" alt="${item.name}" class="w-16 h-16 rounded-lg object-cover" loading="lazy" />
                        <div class="flex-1">
                            <h5 class="font-semibold text-primary">${item.name}</h5>
                            <div class="flex items-center space-x-4 text-sm text-secondary-600">
                                <span>Qty: ${item.quantity}</span>
                                <span>Unit: ${item.price}</span>
                                <span class="font-semibold text-accent">${item.total}</span>
                            </div>
                        </div>
                    </div>
                `).join('');
            }

            populateShippingTimeline(timeline) {
                const container = document.getElementById('shipping-timeline');
                container.innerHTML = `
                    <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-secondary-200"></div>
                    ${timeline.map((step, index) => `
                                                                             <div class="flex items-start space-x-4 ${index !== timeline.length - 1 ? 'mb-8' : ''}">
                                                                                 <div class="w-12 h-12 ${step.completed ? 'bg-success' : 'bg-secondary-200'} rounded-full flex items-center justify-center flex-shrink-0">
                                                                                     ${step.completed ? `
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                ` : `
                                    <svg class="w-6 h-6 text-secondary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                `}
                                                                                 </div>
                                                                                 <div class="flex-1">
                                                                                     <h4 class="font-semibold ${step.completed ? 'text-primary' : 'text-secondary-600'}">${step.status}</h4>
                                                                                     <p class="text-sm ${step.completed ? 'text-success' : 'text-secondary-500'} font-semibold">${step.date}</p>
                                                                                 </div>
                                                                             </div>
                                                                         `).join('')}
                `;
            }

            getStatusClass(status) {
                const classes = {
                    delivered: 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-success-100 text-success-800',
                    shipped: 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800',
                    processing: 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-warning-100 text-warning-800'
                };
                return classes[status] || classes.processing;
            }

            highlightOrderInTable(orderNumber) {
                // Remove previous highlights
                document.querySelectorAll('.order-row').forEach(row => {
                    row.classList.remove('bg-accent-50', 'border-accent');
                });

                // Highlight selected row
                const targetRow = document.querySelector(`[onclick="selectOrder('${orderNumber}')"]`);
                if (targetRow) {
                    targetRow.classList.add('bg-accent-50', 'border-accent');
                }
            }

            clearOrderDetails() {
                document.getElementById('order-details').classList.add('hidden');
                document.getElementById('gps-tracking').classList.add('hidden');
                document.getElementById('order-search').value = '';

                // Remove table highlights
                document.querySelectorAll('.order-row').forEach(row => {
                    row.classList.remove('bg-accent-50', 'border-accent');
                });
            }

            filterOrders(status) {
                // Update filter buttons
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.className =
                        'filter-btn px-3 py-1 rounded-full text-sm font-medium bg-secondary-100 text-secondary-600 hover:bg-secondary-200 transition-fast';
                });
                event.target.className =
                    'filter-btn active px-3 py-1 rounded-full text-sm font-medium bg-accent text-white';

                // Filter table rows
                const rows = document.querySelectorAll('.order-row');
                rows.forEach(row => {
                    const rowStatus = row.dataset.status;
                    if (status === 'all' || rowStatus === status) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });

                this.showToast('Filter Applied', `Showing ${status === 'all' ? 'all' : status} orders`);
            }

            copyReferenceNumber(orderNumber) {
                navigator.clipboard.writeText(orderNumber).then(() => {
                    this.showToast('Copied', `${orderNumber} copied to clipboard`);
                }).catch(() => {
                    // Fallback for older browsers
                    const input = document.createElement('input');
                    input.value = orderNumber;
                    document.body.appendChild(input);
                    input.select();
                    document.execCommand('copy');
                    document.body.removeChild(input);
                    this.showToast('Copied', `${orderNumber} copied to clipboard`);
                });
            }

            showToast(title, message, type = 'success') {
                const toast = document.getElementById('toast-notification');
                const toastTitle = document.getElementById('toast-title');
                const toastMessage = document.getElementById('toast-message');

                const colors = {
                    success: {
                        border: 'border-success',
                        icon: 'text-success'
                    },
                    warning: {
                        border: 'border-warning',
                        icon: 'text-warning'
                    },
                    error: {
                        border: 'border-error',
                        icon: 'text-error'
                    },
                    info: {
                        border: 'border-primary',
                        icon: 'text-primary'
                    }
                };

                const toastContent = toast.querySelector('div');
                toastContent.className =
                    `bg-white shadow-modal rounded-lg p-4 ${colors[type].border} border-l-4 max-w-sm`;

                toastTitle.textContent = title;
                toastMessage.textContent = message;

                toast.classList.remove('translate-x-full');

                setTimeout(() => {
                    this.hideToast();
                }, 4000);
            }

            hideToast() {
                document.getElementById('toast-notification').classList.add('translate-x-full');
            }

            handleMobileView() {
                if (window.innerWidth <= 768) {
                    document.body.style.paddingBottom = '70px';

                    // Make table more mobile-friendly
                    const table = document.querySelector('table');
                    if (table) {
                        table.style.fontSize = '14px';
                    }
                } else {
                    document.body.style.paddingBottom = '0';
                }
            }
        }

        // Initialize Order Tracking Manager
        const orderTracker = new OrderTrackingManager();

        // Global Functions
        function filterOrders(status) {
            orderTracker.filterOrders(status);
        }

        function selectOrder(orderNumber) {
            orderTracker.selectOrder(orderNumber);
        }

        function copyReferenceNumber(orderNumber) {
            event.stopPropagation(); // Prevent row selection
            orderTracker.copyReferenceNumber(orderNumber);
        }

        function searchOrder() {
            orderTracker.searchOrder();
        }

        function handlePaste(event) {
            orderTracker.handlePaste(event);
        }

        function clearOrderDetails() {
            orderTracker.clearOrderDetails();
        }




        // Handle window resize
        window.addEventListener('resize', () => {
            orderTracker.handleMobileView();
        });

        // Auto-focus search on load
        window.addEventListener('load', () => {
            document.getElementById('order-search').focus();
        });


        function applyDateFilter() {
            const from = document.getElementById('date-from').value;
            const to = document.getElementById('date-to').value;
            const params = new URLSearchParams(window.location.search);

            if (from) params.set('from_date', from);
            else params.delete('from_date');

            if (to) params.set('to_date', to);
            else params.delete('to_date');

            // Keep status if already selected
            if (!params.get('status')) {
                params.set('status', 'all');
            }

            window.location.href = "{{ route('order.tracking') }}?" + params.toString();
        }
    </script>
@endsection
