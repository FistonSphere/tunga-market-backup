@extends('admin.layouts.header')

@section('content')
    <style>
        .order-container {
            max-width: 1100px;
            margin: 40px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 20px 30px;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }

        .order-summary h2 {
            margin: 0 0 10px;
            color: #0a2342;
        }

        .order-summary p {
            margin: 4px 0;
        }

        .badge {
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            color: #fff;
        }

        .status-pending {
            background: #f59e0b;
        }

        .status-processing {
            background: #3b82f6;
        }

        .status-delivered {
            background: #10b981;
        }

        .payment-paid {
            background: #16a34a;
        }

        .payment-unpaid {
            background: #dc2626;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
            padding: 8px 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-secondary {
            background: #f59e0b;
            color: white;
            padding: 8px 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-small {
            font-size: 12px;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .danger-btn {
            background: #dc2626;
            color: #fff;
        }

        .edit-btn {
            background: #0284c7;
            color: #fff;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #3b82f6;
            color: #3b82f6;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .items-table th,
        .items-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        .items-table th {
            background: #f1f5f9;
            font-weight: 600;
        }

        .status-dropdown {
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .order-footer {
            border-top: 1px solid #eee;
            margin-top: 20px;
            padding-top: 10px;
            text-align: right;
            color: #555;
        }
    </style>
    <div class="order-container">
        <header class="order-header">
            <div class="order-summary">
                <h2>Order #{{ $order->invoice_number ?? 'N/A' }}</h2>
                <p><strong>Customer:</strong> {{ $order->user->first_name ?? 'Unknown' }} {{ $order->user->last_name ?? '' }}</p>
                <p><strong>Status:</strong>
                    <span class="badge status-{{ strtolower($order->status) }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>
                <p><strong>Total:</strong> {{ number_format($order->total) }} Rwf</p>
                <p><strong>Payment:</strong>
                    <span class="badge payment-{{ $order->payment ? 'paid' : 'unpaid' }}">
                        {{ $order->payment ? 'Paid' : 'Unpaid' }}
                    </span>
                </p>
            </div>
            <div class="order-actions">
                <button class="btn-primary">Mark as Paid</button>
                <button class="btn-secondary">Update Delivery</button>
            </div>
        </header>

        <section class="order-items">
            <h3>Order Items</h3>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Item #</th>
                        <th>Product</th>
                        <th>Variant</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Subtotal</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->product->name ?? 'N/A' }}</td>
                            <td>{{ $item->variant->name ?? '-' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price) }} Rwf</td>
                            <td>{{ number_format($item->quantity * $item->price) }} Rwf</td>
                            <td>
                                <select class="status-dropdown" data-item-id="{{ $item->id }}">
                                    <option value="pending" {{ $item->order->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="processing" {{ $item->order->status == 'processing' ? 'selected' : '' }}>
                                        Processing</option>
                                    <option value="delivered" {{ $item->order->status == 'delivered' ? 'selected' : '' }}>
                                        Delivered</option>
                                </select>
                            </td>
                            <td>
                                <button class="btn-small edit-btn">Edit</button>
                                <button class="btn-small danger-btn">Remove</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <footer class="order-footer">
            <p>Shipping to: {{ $order->shippingAddress->full_address ?? 'N/A' }}</p>
            <p>Invoice #: {{ $order->invoice_number ?? 'Not Generated' }}</p>
            <button class="btn-outline">Generate Invoice</button>
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
