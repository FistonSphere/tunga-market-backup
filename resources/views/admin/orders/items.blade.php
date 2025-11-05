@extends('admin.layouts.header')

@section('content')
    <style>
        /* resources/css/order-details.css */

.order-details-container {
    background: #f9fafc;
    padding: 30px;
    border-radius: 20px;
    max-width: 1200px;
    margin: 30px auto;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    font-family: 'Inter', sans-serif;
    color: #1a202c;
}

/* Header */
.order-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    flex-wrap: wrap;
    margin-bottom: 30px;
    background: #fff;
    padding: 20px 25px;
    border-radius: 16px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.08);
}

.order-info h2 {
    font-size: 1.6rem;
    margin-bottom: 10px;
    color: #0f172a;
}

.order-meta p {
    margin: 4px 0;
    font-size: 0.95rem;
}

.highlight {
    color: #ff7f00;
    font-weight: 600;
}

.badge {
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 0.85rem;
    text-transform: capitalize;
}
.status-processing { background: #ffedcc; color: #b45309; }
.status-delivered { background: #dcfce7; color: #166534; }
.status-canceled { background: #fee2e2; color: #991b1b; }
.payment-paid { background: #d1fae5; color: #065f46; }
.payment-unpaid { background: #fde68a; color: #92400e; }

.order-actions {
    display: flex;
    gap: 10px;
    align-items: center;
}

.btn-primary, .btn-outline {
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
.btn-primary:hover { background: #e86f00; }

.btn-outline {
    background: #fff;
    border: 1px solid #ddd;
}
.btn-outline:hover { background: #f1f1f1; }

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
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease;
}
.item-card:hover { transform: translateY(-4px); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }

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
.edit-btn { background: #fef3c7; color: #92400e; }
.danger-btn { background: #fee2e2; color: #991b1b; }
.btn-small:hover { opacity: 0.9; }

/* Footer */
.order-footer {
    margin-top: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    background: #fff;
    padding: 15px 25px;
    border-radius: 12px;
    box-shadow: 0 1px 5px rgba(0,0,0,0.06);
}
.order-footer p {
    margin: 3px 0;
}
.footer-right button {
    display: flex;
    align-items: center;
    gap: 6px;
}

    </style>
    <div class="order-details-container">
        <header class="order-header">
            <div class="order-info">
                <h2>Order #{{ $order->invoice_number ?? 'N/A' }}</h2>
                <div class="order-meta">
                    <p><strong>Customer:</strong> {{ $order->user->first_name ?? 'Unknown' }}
                        {{ $order->user->last_name ?? '' }}</p>
                    <p><strong>Status:</strong>
                        <span class="badge status-{{ strtolower($order->status) }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                    <p><strong>Total:</strong> <span class="highlight">{{ number_format($order->total) }} Rwf</span></p>
                    <p><strong>Payment:</strong>
                        <span class="badge payment-{{ $order->payment ? 'paid' : 'unpaid' }}">
                            {{ $order->payment ? 'Paid' : 'Unpaid' }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="order-actions">
                <button class="btn-primary">
                    <i class="bi bi-cash-stack"></i> Mark as Paid
                </button>
                <button class="btn-outline">
                    <i class="bi bi-truck"></i> Update Delivery
                </button>
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
                <p><i class="bi bi-geo-alt"></i> Shipping Address: {{ $order->shippingAddress->full_address ?? 'N/A' }}</p>
                <p><i class="bi bi-receipt"></i> Invoice #: {{ $order->invoice_number ?? 'Not Generated' }}</p>
            </div>
            <div class="footer-right">
                <button class="btn-primary"><i class="bi bi-file-earmark-pdf"></i> Generate Invoice</button>
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
