@extends('admin.layouts.header')

@section('content')
    <div class="orders-overview">

        <!-- ===== SUMMARY METRICS ===== -->
        <div class="metrics-container">
            <div class="metric-card total">
                <h3>Total Orders</h3>
                <p class="value">{{ $metrics['total_orders'] }}</p>
            </div>
            <div class="metric-card processing">
                <h3>Processing</h3>
                <p class="value">{{ $metrics['processing'] }}</p>
            </div>
            <div class="metric-card delivered">
                <h3>Delivered</h3>
                <p class="value">{{ $metrics['delivered'] }}</p>
            </div>
            <div class="metric-card cancelled">
                <h3>Cancelled</h3>
                <p class="value">{{ $metrics['cancelled'] }}</p>
            </div>
            <div class="metric-card revenue">
                <h3>Total Revenue</h3>
                <p class="value">{{ number_format($metrics['revenue']) }} Rwf</p>
            </div>
        </div>

        <!-- ===== FILTERS ===== -->
        <div class="orders-header">
            <h1><i class="bi bi-cart-check-fill"></i> Orders Management</h1>
            <div class="order-filters">
                <input type="text" id="searchOrder" placeholder="Search by invoice or customer..." onkeyup="filterOrders()">
                <select id="statusFilter" onchange="filterOrders()">
                    <option value="">All Status</option>
                    <option value="processing">Processing</option>
                    <option value="delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>

        <!-- ===== ORDERS LIST ===== -->
        @forelse($orders as $order)
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <span class="order-label">Invoice:</span>
                        <span class="order-number">{{ $order->invoice_number }}</span>
                    </div>
                    <span class="order-status {{ $order->status }}">{{ ucfirst($order->status) }}</span>
                </div>

                <div class="order-content">
                    <div class="order-section">
                        <h3>Products</h3>
                        @foreach($order->items as $item)
                            <div class="product-item">
                                <img src="{{ $item->product->main_image ?? asset('assets/images/no-image.png') }}" alt="Product">
                                <div>
                                    <p class="product-name">{{ $item->product->name }}</p>
                                    <p class="product-info">Qty: {{ $item->quantity }} × {{ number_format($item->price, 2) }}
                                        {{ $order->currency }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="order-section">
                        <h3>Customer</h3>
                        <p class="customer-name">{{ $order->user->first_name ?? '' }} {{ $order->user->last_name ?? '' }}</p>
                        <p class="customer-email">{{ $order->user->email ?? 'No email' }}</p>
                        <p class="customer-phone">{{ $order->shippingAddress->phone ?? 'No phone' }}</p>
                    </div>

                    <div class="order-section">
                        <h3>Payment & Total</h3>
                        <p class="payment-method">{{ ucfirst($order->payment_method) ?? 'N/A' }}</p>
                        <p class="total-price">{{ number_format($order->total) }} Rwf</p>
                        <p class="created-date">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                <div class="order-footer">
                    <button class="btn view" onclick="viewOrderDetails('{{ $order->id }}')">
                        <i class="bi bi-eye-fill"></i> View Details
                    </button>
                    <button class="btn contact" onclick="openContactModal('{{ $order->id }}')">
                        <i class="bi bi-envelope-fill"></i> Contact Buyer
                    </button>
                </div>
            </div>
        @empty
            <div class="no-orders">
                <i class="bi bi-inbox"></i>
                <p>No orders found.</p>
            </div>
        @endforelse

        <!-- ===== PAGINATION ===== -->
        <div class="pagination-container">
            {{ $orders->links() }}
        </div>
    </div>

@endsection