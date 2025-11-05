@extends('admin.layouts.header')

@section('content')
    <style>
        /* resources/css/order-details.css */

        .order-summary-card {
            background: #fff;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            position: relative;
        }

        /* ====== ACTION BUTTONS ====== */
        .order-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-bottom: 15px;
        }

        .btn-primary,
        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            border-radius: 8px;
            padding: 8px 18px;
            cursor: pointer;
            transition: all 0.25s ease;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: #f97316;
            color: #fff;
            border: none;
            box-shadow: 0 2px 6px rgba(249, 115, 22, 0.4);
        }

        .btn-primary:hover {
            background: #fb923c;
            transform: translateY(-1px);
        }

        .btn-outline {
            background: transparent;
            color: #001428;
            border: 1.5px solid #001428;
        }

        .btn-outline:hover {
            background: #001428;
            color: #fff;
            transform: translateY(-1px);
        }

        /* ====== ORDER SUMMARY GRID ====== */
        .order-title {
            font-size: 1.6rem;
            color: #0f172a;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .order-meta-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
        }

        .meta-card {
            display: flex;
            align-items: center;
            gap: 14px;
            background: #f9fafb;
            border-radius: 12px;
            padding: 16px 20px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
            transition: all 0.25s ease;
        }

        .meta-card:hover {
            background: #fff;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .meta-card .icon {
            font-size: 1.6rem;
            color: #f97316;
        }

        .label {
            font-size: 0.85rem;
            color: #6b7280;
            margin-bottom: 3px;
        }

        .value {
            font-size: 1rem;
            color: #111827;
            font-weight: 500;
        }

        .highlight {
            color: #f97316;
            font-weight: 600;
        }

        /* ===== BADGES ===== */
        .badge {
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 0.85rem;
            text-transform: capitalize;
        }

        .status-processing {
            background: #fff7ed;
            color: #b45309;
        }

        .status-delivered {
            background: #dcfce7;
            color: #166534;
        }

        .status-canceled {
            background: #fee2e2;
            color: #991b1b;
        }

        .payment-paid {
            background: #d1fae5;
            color: #065f46;
        }

        .payment-unpaid {
            background: #fde68a;
            color: #92400e;
        }


        .order-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-primary,
        .btn-outline {
            border: none;
            border-radius: 10px;
            padding: 10px 18px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #ff7f00;
            color: #fff;
        }

        .btn-primary:hover {
            background: #e86f00;
        }

        .btn-outline {
            background: #fff;
            border: 1px solid #ddd;
        }

        .btn-outline:hover {
            background: #f1f1f1;
        }

        /* Items Section */
        .order-items .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .item-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .item-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .item-image img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .item-details {
            padding: 15px;
        }

        .item-details h4 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #0f172a;
        }

        .item-details p {
            margin: 5px 0;
            font-size: 0.9rem;
            color: #4b5563;
        }

        .variant {
            color: #6b7280;
            font-style: italic;
        }

        .item-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            padding: 10px 15px 15px;
        }

        .btn-small {
            border: none;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .edit-btn {
            background: #fef3c7;
            color: #92400e;
        }

        .danger-btn {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn-small:hover {
            opacity: 0.9;
        }

        /* Footer */
        .order-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 18px 22px;
            border-top: 1px solid #eef2f6;
            background: #fff;
            border-radius: 0 0 12px 12px;
            margin-top: 18px;
        }

        .footer-left p {
            margin: 6px 0;
            color: #334155;
            font-size: 0.95rem;
        }

        .footer-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary {
            background: #f97316;
            color: #fff;
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            cursor: pointer;
            display: inline-flex;
            gap: 8px;
            align-items: center;
        }
    </style>
    <div class="order-details-container">
        <header class="order-header">
            <div class="order-summary-card">
                <!-- ===== Order Actions on Top ===== -->
                <div class="order-actions">
                    <button class="btn-primary">
                        <i class="bi bi-cash-stack"></i> Mark as Paid
                    </button>
                    <button class="btn-outline">
                        <i class="bi bi-truck"></i> Update Delivery
                    </button>
                </div>

                <!-- ===== Order Details ===== -->
                <h2 class="order-title">Order #{{ $order->invoice_number ?? 'N/A' }}</h2>

                <div class="order-meta-grid">
                    <div class="meta-card">
                        <i class="bi bi-person-circle icon"></i>
                        <div>
                            <p class="label">Customer</p>
                            <p class="value">{{ $order->user->first_name ?? 'Unknown' }} {{ $order->user->last_name ?? '' }}
                            </p>
                        </div>
                    </div>

                    <div class="meta-card">
                        <i class="bi bi-clipboard-check icon"></i>
                        <div>
                            <p class="label">Status</p>
                            <span class="badge status-{{ strtolower($order->status) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="meta-card">
                        <i class="bi bi-cash icon"></i>
                        <div>
                            <p class="label">Sub Total</p>
                            <p class="value highlight">{{ number_format($order->total - $order->tax_amount) }} Rwf</p>
                        </div>
                    </div>

                    <div class="meta-card">
                        <i class="bi bi-percent icon"></i>
                        <div>
                            <p class="label">Tax</p>
                            <p class="value highlight">{{ number_format($order->tax_amount) }} Rwf</p>
                        </div>
                    </div>

                    <div class="meta-card">
                        <i class="bi bi-wallet2 icon"></i>
                        <div>
                            <p class="label">Total</p>
                            <p class="value highlight">{{ number_format($order->total) }} Rwf</p>
                        </div>
                    </div>

                    <div class="meta-card">
                        <i class="bi bi-credit-card-2-front icon"></i>
                        <div>
                            <p class="label">Payment</p>
                            <span class="badge payment-{{ $order->payment ? 'paid' : 'unpaid' }}">
                                {{ $order->payment ? 'Paid' : 'Unpaid' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section class="order-items">
            <div class="section-header">
                <h3>Ordered Products</h3>
            </div>

            <div class="items-grid">
                @foreach($order->items as $index => $item)
                    <div class="item-card">
                        <div class="item-image">
                            <img src="{{ $item->product->main_image ?? asset('assets/images/no-image.png') }}"
                                alt="Product Image">
                        </div>
                        <div class="item-details">
                            <h4>{{ $item->product->name ?? 'N/A' }}</h4>
                            <p class="variant">{{ $item->variant->name ?? 'Default Variant' }}</p>
                            <p class="price">Unit Price: <strong>{{ number_format($item->price) }} Rwf</strong></p>
                            <p class="quantity">Quantity: <strong>{{ $item->quantity }}</strong></p>
                            <p class="subtotal">Subtotal:
                                <span class="highlight">{{ number_format($item->quantity * $item->price) }} Rwf</span>
                            </p>
                        </div>
                        <div class="item-actions">
                            <button class="btn-small edit-btn"><i class="bi bi-pencil"></i> Edit</button>
                            <button class="btn-small danger-btn"><i class="bi bi-trash"></i> Remove</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <footer class="order-footer">
            <div class="footer-left">
                <div class="shipping-box">
                    <h4><i class="bi bi-geo-alt-fill"></i> Shipping Information</h4>
                    @if($order->shippingAddress)
                        <p class="ship-name">
                            <strong>{{ $order->shippingAddress->first_name }} {{ $order->shippingAddress->last_name }}</strong>
                            @if($order->shippingAddress->company)
                                <span class="ship-company">({{ $order->shippingAddress->company }})</span>
                            @endif
                        </p>
                        <p class="ship-address">
                            {{ $order->shippingAddress->full_address }}
                        </p>
                        <p class="ship-phone">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-telephone" viewBox="0 0 16 16">
                                <path
                                    d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                            </svg> {{ $order->shippingAddress->phone }}
                        </p>
                    @else
                        <p>No shipping address found.</p>
                    @endif
                </div>

                <div class="invoice-box">
                    <p>
                        <i class="bi bi-receipt"></i>
                        Invoice #: <strong>{{ $order->invoice_number ?? 'Not Generated' }}</strong>
                    </p>
                </div>
            </div>

            <div class="footer-right">
                <form action="{{ route('orders.invoice', $order->id) }}" method="get" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
                            <path
                                d="M5.523 12.424q.21-.124.459-.238a8 8 0 0 1-.45.606c-.28.337-.498.516-.635.572l-.035.012a.3.3 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548m2.455-1.647q-.178.037-.356.078a21 21 0 0 0 .5-1.05 12 12 0 0 0 .51.858q-.326.048-.654.114m2.525.939a4 4 0 0 1-.435-.41q.344.007.612.054c.317.057.466.147.518.209a.1.1 0 0 1 .026.064.44.44 0 0 1-.06.2.3.3 0 0 1-.094.124.1.1 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256M8.278 6.97c-.04.244-.108.524-.2.829a5 5 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.5.5 0 0 1 .145-.04c.013.03.028.092.032.198q.008.183-.038.465z" />
                            <path fill-rule="evenodd"
                                d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.7 11.7 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.86.86 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.84.84 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.8 5.8 0 0 0-1.335-.05 11 11 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.24 1.24 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a20 20 0 0 1-1.062 2.227 7.7 7.7 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103" />
                        </svg> Generate Invoice
                    </button>
                </form>
            </div>
        </footer>


    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.status-dropdown').forEach(select => {
                select.addEventListener('change', function () {
                    const itemId = this.dataset.itemId;
                    const status = this.value;

                    fetch(`/admin/order-items/${itemId}/status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ status })
                    })
                        .then(res => res.json())
                        .then(data => alert(`✅ Status updated to ${data.status}`))
                        .catch(err => console.error(err));
                });
            });
        });

    </script>
@endsection
