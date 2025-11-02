<!-- resources/views/orders/index.blade.php -->
@extends('admin.layouts.header')

@section('content')


    <style>
        /* ========= GENERAL STYLING ========= */
        .orders-dashboard {
            padding: 20px 40px;
            background: #f7f8fa;
            min-height: 100vh;
        }

        /* ========= HEADER ========= */
        .orders-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .orders-header h1 {
            font-size: 22px;
            color: #333;
        }

        .orders-header h1 i {
            color: #1b2850;
            margin-right: 6px;
        }

        .order-filters {
            display: flex;
            gap: 10px;
        }

        .order-filters input,
        .order-filters select {
            border: 1px solid #ccc;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
            transition: all 0.2s;
        }

        .order-filters input:focus,
        .order-filters select:focus {
            border-color: #1b2850;
            box-shadow: 0 0 4px rgba(0, 123, 255, 0.2);
        }

        /* ========= ORDER CARD ========= */
        .order-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            padding: 18px 22px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .order-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* ========= ORDER HEADER ========= */
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .order-label {
            color: #666;
            font-size: 13px;
        }

        .order-number {
            font-weight: 600;
            color: #1b2850;
            margin-left: 6px;
        }

        .order-status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .order-status.pending {
            background: #fff3cd;
            color: #ff5f0f;
        }

        .order-status.processing {
            background: #cce5ff;
            color: #ff5f0f;
        }

        .order-status.Delivered {
            background: #d4edda;
            color: #097a24;
        }

        .order-status.cancelled {
            background: #f8d7da;
            color: #8d222d;
        }

        /* ========= ORDER CONTENT ========= */
        .order-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
            gap: 20px;
            margin-top: 15px;
        }

        .order-section h3 {
            font-size: 14px;
            font-weight: 600;
            color: #555;
            margin-bottom: 6px;
        }

        .product-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }

        .product-item img {
            width: 50px;
            height: 50px;
            border-radius: 6px;
            object-fit:fill;
            border: 1px solid #ddd;
        }

        .product-name {
            font-weight: 600;
            color: #333;
        }

        .product-info {
            font-size: 13px;
            color: #777;
        }

        .customer-name {
            font-weight: 600;
            color: #333;
        }

        .customer-email,
        .customer-phone,
        .payment-method,
        .created-date {
            font-size: 13px;
            color: #777;
        }

        .total-price {
            font-weight: 700;
            color: #28a745;
            font-size: 15px;
        }

        /* ========= FOOTER BUTTONS ========= */
        .order-footer {
            text-align: right;
            margin-top: 10px;
        }

        .btn {
            padding: 7px 15px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: background 0.2s;
        }

        .btn.view {
            background: #1b2850;
            color: #fff;
        }

        .btn.view:hover {
            background: #ff5f0f;
        }

        .btn.contact {
            background: #f0f0f0;
            color: #444;
            margin-left: 6px;
        }

        .btn.contact:hover {
            background: #e0e0e0;
        }

        /* ========= EMPTY STATE ========= */
        .no-orders {
            text-align: center;
            color: #aaa;
            margin-top: 60px;
        }

        .no-orders i {
            font-size: 42px;
            color: #ccc;
        }

        .no-orders p {
            margin-top: 10px;
            font-size: 15px;
        }

        /* ========= RESPONSIVE ========= */
        @media (max-width: 768px) {
            .orders-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .order-filters {
                width: 100%;
                flex-direction: column;
            }
        }
    </style>
    <div class="orders-dashboard">

        <div class="orders-header">
            <h1><i class="bi bi-cart-check-fill"></i> Orders Management</h1>
            <div class="order-filters">
                <input type="text" id="searchOrder" placeholder="Search by invoice or customer..." onkeyup="filterOrders()">
                <select id="statusFilter" onchange="filterOrders()">
                    <option value="">All Status</option>
                    <option value="processing">Processing</option>
                    <option value="Delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>

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
                                        {{ $order->currency }}
                                    </p>
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
                    <button class="btn contact">
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

        <div class="pagination">
            {{ $orders->links() }}
        </div>
    </div>



    <script>
        function filterOrders() {
            const search = document.getElementById('searchOrder').value.toLowerCase();
            const status = document.getElementById('statusFilter').value.toLowerCase();
            const cards = document.querySelectorAll('.order-card');

            cards.forEach(card => {
                const text = card.innerText.toLowerCase();
                const matchesSearch = text.includes(search);
                const matchesStatus = status ? text.includes(status) : true;
                card.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
            });
        }
    </script>
@endsection