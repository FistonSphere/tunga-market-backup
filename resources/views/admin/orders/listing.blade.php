<!-- resources/views/orders/index.blade.php -->
@extends('admin.layouts.header')

@section('content')


    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Modal Box */
        .modal-box {
            background: #fff;
            width: 500px;
            border-radius: 10px;
            padding: 25px;
            position: relative;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .modal-box h2 {
            color: #f97316;
            margin-bottom: 15px;
            font-size: 20px;
        }

        .close-modal {
            position: absolute;
            right: 20px;
            top: 15px;
            font-size: 22px;
            color: #777;
            cursor: pointer;
        }

        .close-modal:hover {
            color: #f97316;
        }

        /* ====== Modal Overlay ====== */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 20, 40, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2000;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* ====== Modal Box ====== */
        .modal-content {
            background: #fff;
            width: 850px;
            max-height: 90vh;
            overflow-y: auto;
            border-radius: 14px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.2);
            padding: 25px 35px;
            position: relative;
            animation: slideUp 0.4s ease;
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* ====== Close Button ====== */
        .close-modal {
            position: absolute;
            right: 20px;
            top: 18px;
            font-size: 24px;
            color: #666;
            cursor: pointer;
            transition: 0.3s;
        }

        .close-modal:hover {
            color: #f97316;
        }

        /* ====== Header ====== */
        .order-detail-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #f5f5f5;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .order-detail-header h2 {
            font-size: 20px;
            color: #001428;
            font-weight: 700;
        }

        .order-detail-header small {
            font-size: 14px;
            color: #777;
            margin-left: 6px;
        }

        .order-status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .order-status-badge.pending {
            background: #fff3cd;
            color: #856404;
        }

        .order-status-badge.processing {
            background: #cce5ff;
            color: #004085;
        }

        .order-status-badge.completed {
            background: #d4edda;
            color: #155724;
        }

        .order-status-badge.cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        /* ====== Sections ====== */
        .section {
            background: #fafbfc;
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        .section:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            transform: translateY(-1px);
        }

        .section h3 {
            font-size: 15px;
            color: #f97316;
            margin-bottom: 10px;
        }

        .section p {
            font-size: 14px;
            margin: 3px 0;
            color: #333;
        }

        /* ====== Product List ====== */
        .product-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .product-item {
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        .product-item .info {
            flex: 1;
        }

        .product-item .info h4 {
            font-size: 14px;
            color: #001428;
            margin-bottom: 2px;
        }

        .product-item .info span {
            font-size: 13px;
            color: #666;
        }

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
            object-fit: fill;
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

        #contactBuyerForm {
            display: flex;
            flex-direction: column;
            gap: 15px;
            padding: 10px;
        }

        .form-group label {
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            resize: vertical;
            transition: all 0.2s ease-in-out;
        }

        textarea:focus {
            border-color: #ff6b00;
            box-shadow: 0 0 4px rgba(255, 107, 0, 0.3);
            outline: none;
        }

        .btn-send {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: #ff6b00;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .btn-send:hover {
            background-color: #e25f00;
        }


        .spinner {
            width: 18px;
            height: 18px;
            border: 3px solid #fff;
            border-top: 3px solid transparent;
            border-radius: 50%;
            display: none;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .loading .btn-text {
            opacity: 0.6;
        }

        .loading .spinner {
            display: inline-block;
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .pagination-list {
            display: flex;
            list-style: none;
            padding: 0;
            gap: 8px;
            background: #fff;
            border-radius: 8px;
            padding: 8px 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            font-family: "Segoe UI", sans-serif;
        }

        .pagination-list li {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .pagination-list li a {
            text-decoration: none;
            color: #444;
            padding: 8px 12px;
            border-radius: 6px;
            display: inline-block;
            transition: all 0.25s ease;
        }

        .pagination-list li a:hover {
            background-color: #ff6b00;
            color: #fff;
            box-shadow: 0 3px 6px rgba(255, 107, 0, 0.25);
            transform: translateY(-2px);
        }

        .pagination-list li.active {
            background-color: #ff6b00;
            color: #fff;
            box-shadow: 0 3px 6px rgba(255, 107, 0, 0.3);
            pointer-events: none;
        }

        .pagination-list li.disabled {
            color: #ccc;
            opacity: 0.6;
            cursor: not-allowed;
        }

        .pagination-list li.disabled:hover {
            transform: none;
            box-shadow: none;
        }

        /* ===== METRICS ===== */
        .metrics-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .metric-card {
            flex: 1;
            min-width: 180px;
            background: #fff;
            border-radius: 12px;
            padding: 18px 22px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.25s ease;
        }

        .metric-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .metric-card h3 {
            font-size: 15px;
            font-weight: 600;
            color: #555;
            margin-bottom: 10px;
        }

        .metric-card .value {
            font-size: 24px;
            font-weight: 700;
        }

        .metric-card.total .value {
            color: #001428;
        }

        .metric-card.processing .value {
            color: #007bff;
        }

        .metric-card.delivered .value {
            color: #28a745;
        }

        .metric-card.cancelled .value {
            color: #dc3545;
        }

        .metric-card.revenue .value {
            color: #f97316;
        }
    </style>
    <div class="orders-dashboard">
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

        <div class="orders-header">
            <h1><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-cart-check-fill" viewBox="0 0 16 16">
                    <path
                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708" />
                </svg> Orders Management</h1>


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
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                            <path
                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                        </svg> View Details
                    </button>
                    <button class="btn contact" onclick="openContactModal('{{ $order->id }}')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-envelope-fill" viewBox="0 0 16 16">
                            <path
                                d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                        </svg> Contact Buyer
                    </button>

                </div>
            </div>
        @empty
            <div class="no-orders">
                <i class="bi bi-inbox"></i>
                <p>No orders found.</p>
            </div>
        @endforelse

        @if ($orders->hasPages())
            <div class="pagination-container">
                <ul class="pagination-list">
                    {{-- Previous Page Link --}}
                    @if ($orders->onFirstPage())
                        <li class="disabled">&laquo;</li>
                    @else
                        <li>
                            <a href="{{ $orders->previousPageUrl() }}" rel="prev">&laquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($orders->links()->elements[0] ?? [] as $page => $url)
                        @if ($page == $orders->currentPage())
                            <li class="active">{{ $page }}</li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($orders->hasMorePages())
                        <li>
                            <a href="{{ $orders->nextPageUrl() }}" rel="next">&raquo;</a>
                        </li>
                    @else
                        <li class="disabled">&raquo;</li>
                    @endif
                </ul>
            </div>
        @endif

    </div>

    <!-- ORDER DETAILS MODAL -->
    <div id="orderDetailsModal" class="modal-overlay" style="display:none;">
        <div class="modal-content">
            <span class="close-modal" onclick="closeOrderModal()">&times;</span>

            <!-- HEADER -->
            <div class="order-detail-header">
                <h2>Order Details <small id="orderInvoice"></small></h2>
                <span id="orderStatus" class="order-status-badge"></span>
            </div>

            <!-- BODY -->
            <div class="order-detail-body">

                <!-- CUSTOMER INFORMATION -->
                <section class="section">
                    <h3>Customer Information</h3>
                    <p><strong>Name:</strong> <span id="customerName"></span></p>
                    <p><strong>Email:</strong> <span id="customerEmail"></span></p>
                </section>

                <!-- SHIPPING DETAILS -->
                <section class="section">
                    <h3>Shipping Address</h3>
                    <div id="shippingDetails">
                        <p><strong>Recipient:</strong> <span id="shipName"></span></p>
                        <p><strong>Company:</strong> <span id="shipCompany"></span></p>
                        <p><strong>Address:</strong> <span id="shipAddress"></span></p>
                        <p><strong>City:</strong> <span id="shipCity"></span></p>
                        <p><strong>State:</strong> <span id="shipState"></span></p>
                        <p><strong>Postal Code:</strong> <span id="shipPostal"></span></p>
                        <p><strong>Country:</strong> <span id="shipCountry"></span></p>
                        <p><strong>Phone:</strong> <span id="shipPhone"></span></p>
                    </div>
                </section>

                <!-- ORDERED PRODUCTS -->
                <section class="section">
                    <h3>Ordered Products</h3>
                    <div id="orderProducts" class="product-list"></div>
                </section>

                <!-- PAYMENT INFO -->
                <section class="section">
                    <h3>Payment & Order Summary</h3>
                    <p><strong>Payment Method:</strong> <span id="paymentMethod"></span></p>
                    <p><strong>Total:</strong> <span id="orderTotal"></span></p>
                    <p><strong>Date:</strong> <span id="orderDate"></span></p>
                </section>
            </div>
        </div>
    </div>

    <!-- CONTACT BUYER MODAL -->
    <div id="contactBuyerModal" class="modal-overlay" style="display:none;">
        <div class="modal-box">
            <span class="close-modal" onclick="closeContactModal()">&times;</span>
            <h2>Contact Buyer</h2>

            <form id="contactBuyerForm" method="POST" action="{{ route('admin.orders.contact-buyer') }}">
                @csrf
                <input type="hidden" name="order_id" id="contactOrderId">
                <div class="form-group">
                    <label for="message">Message to Buyer</label>
                    <textarea name="message" id="contactMessage" rows="6" required
                        placeholder="Type your message here..."></textarea>
                </div>
                <button type="submit" class="btn-send" id="sendBtn">
                    <span class="btn-text">Send Message</span>
                    <span class="spinner" id="spinner"></span>
                </button>
            </form>
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


        function viewOrderDetails(orderId) {
            fetch(`/admin/orders/${orderId}/show`)
                .then(response => response.json())
                .then(order => {
                    // Header
                    document.getElementById('orderInvoice').textContent = `#${order.invoice_number}`;
                    const badge = document.getElementById('orderStatus');
                    badge.textContent = order.status;
                    badge.className = `order-status-badge ${order.status}`;

                    // Customer Info
                    document.getElementById('customerName').textContent = `${order.user.first_name} ${order.user.last_name}`;
                    document.getElementById('customerEmail').textContent = order.user.email || 'N/A';

                    // Shipping Info
                    const s = order.shipping_address;
                    document.getElementById('shipName').textContent = `${s?.first_name ?? ''} ${s?.last_name ?? ''}`;
                    document.getElementById('shipCompany').textContent = s?.company || '—';
                    document.getElementById('shipAddress').textContent = `${s?.address_line1 ?? ''} ${s?.address_line2 ?? ''}`;
                    document.getElementById('shipCity').textContent = s?.city || '—';
                    document.getElementById('shipState').textContent = s?.state || '—';
                    document.getElementById('shipPostal').textContent = s?.postal_code || '—';
                    document.getElementById('shipCountry').textContent = s?.country || '—';
                    document.getElementById('shipPhone').textContent = s?.phone || '—';

                    // Payment
                    document.getElementById('paymentMethod').textContent = order.payment_method ?? 'N/A';
                    document.getElementById('orderTotal').textContent = `${order.total.toLocaleString()} Rwf`;
                    document.getElementById('orderDate').textContent = new Date(order.created_at).toLocaleString();

                    // Products
                    const productsContainer = document.getElementById('orderProducts');
                    productsContainer.innerHTML = '';
                    order.items.forEach(item => {
                        const div = document.createElement('div');
                        div.classList.add('product-item');
                        div.innerHTML = `
                                                                                                          <img src="${item.product?.main_image || '/images/no-image.png'}" alt="">
                                                                                                          <div class="info">
                                                                                                            <h4>${item.product?.name ?? 'Unknown Product'}</h4>
                                                                                                            <span>Qty: ${item.quantity} × ${item.price}</span>
                                                                                                          </div>`;
                        productsContainer.appendChild(div);
                    });

                    // Show Modal
                    document.getElementById('orderDetailsModal').style.display = 'flex';
                })
                .catch(err => console.error(err));
        }

        function closeOrderModal() {
            document.getElementById('orderDetailsModal').style.display = 'none';
        }

        function openContactModal(orderId) {
            document.getElementById('contactOrderId').value = orderId;
            document.getElementById('contactBuyerModal').style.display = 'flex';
        }
        function closeContactModal() {
            document.getElementById('contactBuyerModal').style.display = 'none';
        }

        document.getElementById('contactBuyerForm').addEventListener('submit', function (e) {
            const sendBtn = document.getElementById('sendBtn');
            sendBtn.classList.add('loading');
            sendBtn.disabled = true;
        });

        document.querySelectorAll('.pagination-list a').forEach(link => {
            link.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });
    </script>
@endsection