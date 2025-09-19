<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Professional Invoice - Tunga Market</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <meta name="description"
        content="Professional invoice template with QR code for order tracking - Download and print your Tunga Market invoice" />

    <!-- Print-specific styles -->
    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
                background: white !important;
            }

            .no-print {
                display: none !important;
            }

            .invoice-container {
                box-shadow: none !important;
                margin: 0 !important;
            }

            .qr-code-container {
                page-break-inside: avoid;
            }

            .footer {
                page-break-inside: avoid;
            }
        }

        .qr-code-canvas {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            background: white;
        }

        .invoice-table th {
            background-color: #f8fafc;
            border-bottom: 2px solid #e5e7eb;
        }

        .invoice-table tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .invoice-header {
            border-bottom: 3px solid #3b82f6;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
        }

        .total-section {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border: 2px solid #0ea5e9;
            border-radius: 12px;
        }

        @media (max-width: 768px) {
            .invoice-grid {
                grid-template-columns: 1fr !important;
            }

            .qr-code-container {
                text-align: center;
                margin-top: 1rem;
            }
        }
    </style>

</head>

<body class="bg-secondary-50 text-text-primary">
    <!-- Print Controls -->
    <div class="no-print bg-white shadow-card sticky top-0 z-50 border-b">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <button onclick="window.history.back()"
                        class="flex items-center space-x-2 text-secondary-600 hover:text-primary transition-fast">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Back to Dashboard</span>
                    </button>
                    <div class="h-4 w-px bg-secondary-300"></div>
                    <h1 class="text-lg font-semibold text-primary">Professional Invoice</h1>
                </div>
                <div class="flex items-center space-x-3">
                    <button onclick="downloadPDF()" class="btn-secondary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Download PDF
                    </button>
                    <button onclick="window.print()" class="btn-primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Print Invoice
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoice Document -->
    <div class="min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="invoice-container bg-white shadow-modal rounded-lg overflow-hidden">
                <!-- Invoice Header -->
                {{-- Invoice Header (dynamic) --}}
                <div class="invoice-header p-8">
                    <div class="grid lg:grid-cols-3 gap-8 items-start">
                        <!-- Company Logo & Info -->
                        <div class="lg:col-span-2">
                            <div class="flex items-center space-x-4 mb-6">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="Tunga Market Logo"
                                    class="block rounded-lg" style="width:150px; height:100px; object-fit:cover;" />

                                <div>
                                    <h1 class="text-3xl font-bold" style="color:#FF6600;">Tunga Market</h1>
                                    <p class="text-sm text-gray-600">Where Business Grows Together</p>
                                </div>
                            </div>

                            <div class="space-y-1 text-gray-700">
                                <p class="font-semibold">Tunga Market Inc.</p>
                                <p>123 Commerce Drive, Suite 500</p>
                                <p>San Francisco, CA 94107, United States</p>
                                <p>Phone: +1 (555) 123-4567</p>
                                <p>Email: billing@tungamarket.com</p>
                                <p>Tax ID: 12-3456789</p>
                            </div>
                        </div>

                        <!-- QR Code for Order Tracking -->
                        <div class="qr-code-container text-center">
                            <div class="bg-surface p-4 rounded-lg border-2" style="border-color: #E6EEF6;">
                                <h3 class="text-sm font-semibold" style="color:#001327;">Quick Order Tracking</h3>

                                {{-- QR Code (inline SVG) — works great for browser print and keeps styling intact --}}
                                <div class="mx-auto my-3" style="width:120px; height:120px;">
                                    {{-- Make sure you have simplesoftwareio/simple-qrcode package installed --}}
                                    {{-- The route should point to a public tracking page. Using order.show is fine if accessible. --}}
                                    {!! QrCode::size(120)->margin(0)->generate(route('orders.show', $order->id)) !!}
                                </div>

                                <p class="text-xs text-gray-500 mt-2">Scan to view order details</p>

                                {{-- order reference/tracking id (generated on the fly if you don't have an order_no) --}}
                                @php
                                    // friendly tracking reference: AM{YEAR}-{zero-padded-order-id}
                                    $trackingRef =
                                        'AM' .
                                        now()->format('Y') .
                                        '-' .
                                        str_pad($order->id ?? 0, 6, '0', STR_PAD_LEFT);
                                @endphp
                                <p class="text-xs font-semibold" style="color:#FF6600;">
                                    {{ $order->invoice_number ?? $trackingRef }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Top-right small meta row (invoice + order date) --}}
                    <div class="mt-6 flex justify-between items-center">
                        <div>
                            <div class="text-sm text-gray-600">Invoice Number</div>
                            <div class="font-semibold text-lg" style="color:#001327;">
                                {{ $order->invoice_number ?? $order->generateInvoiceNumber() }}
                            </div>
                        </div>

                        <div class="text-right">
                            <div class="text-sm text-gray-600">Order Reference</div>
                            <div class="font-semibold text-lg" style="color:#001327;">
                                {{ $order->items->first()->order_no }}
                            </div>

                            <div class="text-sm text-gray-500 mt-1">
                                {{ $order->created_at ? $order->created_at->format('F d, Y \a\t h:i A') : now()->format('F d, Y') }}
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Invoice Details -->
                <div class="px-8 pb-8">
                    <div class="invoice-grid grid lg:grid-cols-3 gap-8 mb-8">
                        <!-- Invoice Info -->
                        <div>
                            <h2 class="text-xl font-bold text-primary mb-4">Invoice Details</h2>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Invoice Number:</span>
                                    <span class="font-semibold text-primary">
                                        {{ $order->invoice_number ?? $order->generateInvoiceNumber() }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Order Number:</span>
                                    <span class="font-semibold text-primary">
                                        #{{ 'AM' . $order->created_at->format('Y') . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Invoice Date:</span>
                                    <span class="font-semibold">
                                        {{ $order->created_at->format('F d, Y') }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Due Date:</span>
                                    <span class="font-semibold">
                                        {{ $order->created_at->copy()->addDays(30)->format('F d, Y') }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Payment Method:</span>
                                    <span class="font-semibold">
                                        {{ $order->payment?->method ?? 'N/A' }}
                                        @if ($order->payment?->card_last4)
                                            •••• {{ $order->payment->card_last4 }}
                                        @endif
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Currency:</span>
                                    <span class="font-semibold">{{ $order->currency ?? 'USD ($)' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bill To -->
                        <div>
                            <h2 class="text-xl font-bold text-primary mb-4">Bill To</h2>
                            <div class="space-y-1 text-secondary-700">
                                <p class="font-semibold text-primary">{{ $order->customer?->name ?? 'N/A' }}</p>
                                <p class="font-semibold">{{ $order->customer?->company ?? '-' }}</p>
                                <p>{{ $order->billingAddress?->street ?? '-' }}</p>
                                <p>{{ $order->billingAddress?->city ?? '' }}
                                    {{ $order->billingAddress?->postal_code ?? '' }}</p>
                                <p>{{ $order->billingAddress?->country ?? '' }}</p>
                                <p class="mt-3 font-semibold">Contact Information:</p>
                                <p>Email: {{ $order->customer?->email ?? '-' }}</p>
                                <p>Phone: {{ $order->customer?->phone ?? '-' }}</p>
                                <p>Tax ID: {{ $order->customer?->tax_id ?? '-' }}</p>
                            </div>
                        </div>

                        <!-- Ship To -->
                        <div>
                            <h2 class="text-xl font-bold text-primary mb-4">Ship To</h2>
                            <div class="space-y-1 text-secondary-700">
                                <p class="font-semibold text-primary">{{ $order->shippingAddress?->company ?? '-' }}
                                </p>
                                <p>{{ $order->shippingAddress?->recipient ?? '-' }}</p>
                                <p>{{ $order->shippingAddress?->street ?? '-' }}</p>
                                <p>{{ $order->shippingAddress?->city ?? '' }}
                                    {{ $order->shippingAddress?->postal_code ?? '' }}</p>
                                <p>{{ $order->shippingAddress?->country ?? '' }}</p>
                                <p class="mt-3 font-semibold">Delivery Instructions:</p>
                                <p>{{ $order->shippingAddress?->instructions ?? 'Standard delivery' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Items Table -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-primary mb-4">Order Items</h2>
                        <div class="overflow-x-auto">
                            <table class="invoice-table w-full border-collapse border border-secondary-200">
                                <thead>
                                    <tr class="bg-surface">
                                        <th class="border px-4 py-3 text-left text-sm font-semibold text-primary">
                                            Description</th>
                                        <th class="border px-4 py-3 text-left text-sm font-semibold text-primary">
                                            Supplier</th>
                                        <th class="border px-4 py-3 text-center text-sm font-semibold text-primary">Qty
                                        </th>
                                        <th class="border px-4 py-3 text-right text-sm font-semibold text-primary">Unit
                                            Price</th>
                                        <th class="border px-4 py-3 text-right text-sm font-semibold text-primary">Tax
                                            Rate</th>
                                        <th class="border px-4 py-3 text-right text-sm font-semibold text-primary">Line
                                            Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td class="border px-4 py-4">
                                                <p class="font-semibold text-primary">{{ $item->product_name }}</p>
                                                <p class="text-sm text-secondary-600">SKU: {{ $item->sku ?? '-' }}</p>
                                            </td>
                                            <td class="border px-4 py-4">
                                                <p class="font-semibold text-primary">
                                                    {{ $item->supplier_name ?? '-' }}</p>
                                                <p class="text-sm text-secondary-600">
                                                    {{ $item->supplier_location ?? '' }}</p>
                                            </td>
                                            <td class="border px-4 py-4 text-center font-semibold">
                                                {{ $item->quantity }}</td>
                                            <td class="border px-4 py-4 text-right font-semibold">
                                                {{ number_format($item->unit_price, 2) }}
                                                {{ $order->currency ?? 'USD' }}
                                            </td>
                                            <td class="border px-4 py-4 text-right">{{ $item->tax_rate ?? '10%' }}
                                            </td>
                                            <td class="border px-4 py-4 text-right font-semibold text-accent">
                                                {{ number_format($item->total, 2) }} {{ $order->currency ?? 'USD' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Totals Section -->
                    <div class="grid lg:grid-cols-2 gap-8 mb-8">
                        <!-- Payment & Shipping Info -->
                        <div>
                            <h3 class="text-lg font-semibold text-primary mb-4">Payment & Shipping Details</h3>
                            <div class="space-y-4">
                                <div class="bg-surface p-4 rounded-lg">
                                    <h4 class="font-semibold text-primary mb-2">Payment Information</h4>
                                    <div class="space-y-1 text-sm">
                                        <p><span class="text-secondary-600">Method:</span>
                                            {{ $order->payment?->method ?? '-' }}</p>
                                        <p><span class="text-secondary-600">Transaction ID:</span>
                                            {{ $order->payment?->transaction_id ?? '-' }}</p>
                                        <p><span class="text-secondary-600">Authorization:</span>
                                            {{ $order->payment?->authorization_code ?? '-' }}</p>
                                        <div class="mt-2 flex items-center space-x-2">
                                            @if ($order->payment?->status === 'paid')
                                                <svg class="w-4 h-4 text-success" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span class="text-success font-semibold text-sm">Payment
                                                    Verified</span>
                                            @else
                                                <span class="text-warning font-semibold text-sm">Pending</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-surface p-4 rounded-lg">
                                    <h4 class="font-semibold text-primary mb-2">Shipping Information</h4>
                                    <div class="space-y-1 text-sm">
                                        <p><span class="text-secondary-600">Method:</span>
                                            {{ $order->shipping_method ?? '-' }}</p>
                                        <p><span class="text-secondary-600">Carrier:</span>
                                            {{ $order->shipping_carrier ?? '-' }}</p>
                                        <p><span class="text-secondary-600">Tracking Number:</span>
                                            {{ $order->tracking_number ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Totals -->
                        <div>
                            <div class="total-section p-6">
                                <h3 class="text-lg font-semibold text-primary mb-4">Invoice Summary</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-secondary-700">Subtotal:</span>
                                        <span class="font-semibold">{{ number_format($subtotal, 2) }}
                                            {{ $order->currency ?? 'USD' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-secondary-700">Tax (10%):</span>
                                        <span class="font-semibold">{{ number_format($tax, 2) }}
                                            {{ $order->currency ?? 'USD' }}</span>
                                    </div>
                                    <div class="border-t border-secondary-300 pt-3">
                                        <div class="flex justify-between items-center">
                                            <span class="text-xl font-bold text-primary">Total Amount:</span>
                                            <span
                                                class="text-2xl font-bold text-accent">{{ number_format($finalTotal, 2) }}
                                                {{ $order->currency ?? 'USD' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Status -->
                                <div
                                    class="mt-4 p-3 {{ $order->payment?->status === 'paid' ? 'bg-success-50 border-success-200' : 'bg-warning-50 border-warning-200' }} border rounded-lg">
                                    <div class="flex items-center space-x-2">
                                        @if ($order->payment?->status === 'paid')
                                            <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="font-semibold text-success-700">PAID IN FULL</span>
                                            <p class="text-success-600 text-sm mt-1">Payment received on
                                                {{ $order->payment?->updated_at?->format('F d, Y') }}</p>
                                        @else
                                            <span class="font-semibold text-warning-700">AWAITING PAYMENT</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Invoice Footer -->
                <div class="footer bg-secondary-800 text-white p-6">
                    <div class="grid md:grid-cols-3 gap-6 text-center md:text-left">
                        <div>
                            <p class="font-semibold mb-2">Tunga Market Inc.</p>
                            <p class="text-secondary-300 text-sm">Global B2B Commerce Platform</p>
                            <p class="text-secondary-300 text-sm">Est. 2020 • San Francisco, CA</p>
                        </div>
                        <div>
                            <p class="font-semibold mb-2">Thank You for Your Business!</p>
                            <p class="text-secondary-300 text-sm">Your partnership drives our innovation</p>
                            <p class="text-secondary-300 text-sm">Where Business Grows Together</p>
                        </div>
                        <div>
                            <p class="font-semibold mb-2">Questions?</p>
                            <p class="text-secondary-300 text-sm">support@tungamarket.com</p>
                            <p class="text-secondary-300 text-sm">+1 (555) 123-4567</p>
                        </div>
                    </div>
                    <div class="border-t border-secondary-700 mt-6 pt-4 text-center">
                        <p class="text-secondary-400 text-sm">
                            This invoice was generated on January 26, 2025 at 16:19 UTC •
                            Invoice ID: INV-2025-789456 •
                            For authentication, verify at: verify.tungamarket.com
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
