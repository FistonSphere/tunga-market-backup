<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->invoice_number }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            color: #001327;
            background: #fff;
        }

        .invoice-container {
            width: 95%;
            margin: 20px auto;
            padding: 25px;
            border: 1px solid #eee;
            border-radius: 12px;
            background: #fafafa;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #FF6600;
        }

        .header img {
            height: 60px;
        }

        .header h1 {
            color: #FF6600;
            /* Brand Orange */
            font-size: 26px;
            margin: 0;
        }

        .details {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }

        .details div {
            width: 48%;
        }

        .items {
            margin-top: 30px;
            width: 100%;
            border-collapse: collapse;
        }

        .items th {
            background: #001327;
            color: #fff;
            text-align: left;
            padding: 10px;
            font-size: 14px;
        }

        .items td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .totals {
            margin-top: 20px;
            float: right;
            width: 40%;
        }

        .totals table {
            width: 100%;
            border-collapse: collapse;
        }

        .totals td {
            padding: 8px;
            font-size: 14px;
        }

        .totals tr:last-child td {
            font-size: 16px;
            font-weight: bold;
            color: #001327;
            border-top: 2px solid #FF6600;
        }

        .qrcode {
            margin-top: 30px;
            text-align: right;
        }

        .footer {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="invoice-container">

        <!-- Header -->
        <div class="header">
            <img src="{{ public_path('logo.png') }}" alt="Tunga Market Logo">
            <h1>Invoice</h1>
        </div>

        <!-- Invoice Details -->
        <div class="details">
            <div>
                <strong>Invoice Number:</strong> {{ $order->invoice_number }}<br>
                <strong>Date:</strong> {{ $order->created_at->format('d M Y') }}<br>
                <strong>Status:</strong> {{ ucfirst($order->status) }}
            </div>
            <div>
                <strong>Billed To:</strong><br>
                {{ $order->shippingAddress->first_name }}<br>
                {{ $order->shippingAddress->user->email }}<br>
                {{ $order->shippingAddress->phone }}
            </div>
        </div>

        <!-- Items Table -->
        <table class="items">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 2) }} RWF</td>
                        <td>{{ number_format($item->price * $item->quantity, 2) }} RWF</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="totals">
            <table>
                <tr>
                    <td>Subtotal:</td>
                    <td>{{ number_format($order->subtotal, 2) }} RWF</td>
                </tr>
                <tr>
                    <td>Tax (10%):</td>
                    <td>{{ number_format($order->subtotal * 0.1, 2) }} RWF</td>
                </tr>
                <tr>
                    <td>Total:</td>
                    <td>{{ number_format($order->subtotal * 1.1, 2) }} RWF</td>
                </tr>
            </table>
        </div>
        @php
            $qrcode = QrCode::format('svg')
                ->size(120)
                ->generate(route('orders.show', $order->id));
        @endphp
        <!-- QR Code -->
        <div class="qrcode">
            {!! $qrcode !!}
            <p style="font-size: 12px; color:#555;">Scan to view order details</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            Thank you for shopping with <strong>Tunga Market</strong>! <br>
            For support, contact us at support@tungamarket.com
        </div>
    </div>
</body>

</html>
