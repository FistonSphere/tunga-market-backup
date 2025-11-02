<!-- resources/views/orders/index.blade.php -->
@extends('admin.layouts.header')

@section('content')


    <style>
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
    </style>
    <div class="orders-dashboard">

        <div class="orders-header">
            <h1><i class="bi bi-cart-check-fill"></i> Orders Management</h1>
            <form class="order-filters" method="GET">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search invoice or customer...">
                <select name="status" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    @foreach(['pending', 'processing', 'delivered', 'cancelled'] as $st)
                        <option value="{{ $st }}" {{ request('status') == $st ? 'selected' : '' }}>
                            {{ ucfirst($st) }}
                        </option>
                    @endforeach
                </select>
                <button type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>


        @forelse($orders as $order)
            <div class="order-card">
                <div class="order-header">
                    <div class="left">
                        <span class="order-label">Invoice:</span>
                        <span class="order-number">#{{ $order->invoice_number }}</span>
                        <span class="item-count badge bg-light text-dark">{{ $order->items_count }} items</span>
                    </div>
                    <span class="order-status badge bg-{{ match ($order->status) {
                'pending' => 'warning',
                'processing' => 'info',
                'delivered' => 'success',
                'cancelled' => 'danger',
                default => 'secondary'
            } }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <div class="order-body">
                    <div class="product-thumbs">
                        @foreach($order->items->take(3) as $item)
                            <img src="{{ $item->product->main_image ?? asset('assets/images/no-image.png') }}" alt="">
                        @endforeach
                        @if($order->items->count() > 3)
                            <span class="more-items">+{{ $order->items->count() - 3 }} more</span>
                        @endif
                    </div>

                    <div class="order-info">
                        <h4>{{ $order->user->first_name ?? '' }} {{ $order->user->last_name ?? '' }}</h4>
                        <p class="text-muted">{{ $order->user->email ?? '' }}</p>
                        <p><strong>{{ number_format($order->total) }} {{ $order->currency }}</strong> —
                            {{ ucfirst($order->payment_method) }}</p>
                        <small class="text-secondary">{{ $order->created_at->format('d M Y, H:i') }}</small>
                    </div>
                </div>

                <div class="order-footer">
                    <button class="btn btn-outline-primary btn-sm" onclick="viewOrderDetails('{{ $order->id }}')">
                        <i class="bi bi-eye"></i> View Details
                    </button>
                    <button class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-envelope"></i> Contact Buyer
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
                    <p><strong>Currency:</strong> <span id="orderCurrency"></span></p>
                    <p><strong>Date:</strong> <span id="orderDate"></span></p>
                </section>
            </div>
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


      async function viewOrderDetails(orderId) {
    const modal = document.getElementById('orderDetailsModal');
    modal.style.display = 'flex';
    modal.querySelector('.order-detail-body').innerHTML = '<div class="loader">Loading...</div>';

    try {
        const res = await fetch(`/admin/orders/${orderId}/show`);
        const data = await res.json();
        const order = data.data;

        // Header
        document.getElementById('orderInvoice').textContent = `#${order.invoice_number}`;
        const badge = document.getElementById('orderStatus');
        badge.textContent = order.status;
        badge.className = `order-status-badge ${order.status}`;

        // Build content dynamically
        const html = `
            <section class="section">
                <h3>Customer Information</h3>
                <p><strong>Name:</strong> ${order.user.first_name} ${order.user.last_name}</p>
                <p><strong>Email:</strong> ${order.user.email || 'N/A'}</p>
            </section>

            <section class="section">
                <h3>Shipping Address</h3>
                <p><strong>Address:</strong> ${order.shipping_address?.address_line1 || '—'}, ${order.shipping_address?.city || ''}</p>
                <p><strong>Phone:</strong> ${order.shipping_address?.phone || '—'}</p>
            </section>

            <section class="section">
                <h3>Products</h3>
                ${order.items.map(i => `
                    <div class="product-item">
                        <img src="${i.product?.main_image || '/images/no-image.png'}" alt="">
                        <div><strong>${i.product?.name}</strong><br>Qty: ${i.quantity} × ${i.price}</div>
                    </div>`).join('')}
            </section>

            <section class="section">
                <h3>Payment & Order Summary</h3>
                <p><strong>Method:</strong> ${order.payment_method}</p>
                <p><strong>Total:</strong> ${Number(order.total).toLocaleString()} ${order.currency}</p>
                <p><strong>Date:</strong> ${new Date(order.created_at).toLocaleString()}</p>
            </section>
        `;
        modal.querySelector('.order-detail-body').innerHTML = html;
    } catch (err) {
        console.error(err);
        modal.querySelector('.order-detail-body').innerHTML = '<p class="text-danger">Failed to load order details.</p>';
    }
}

function closeOrderModal() {
    document.getElementById('orderDetailsModal').style.display = 'none';
}
</script>
@endsection