@php
    $gs = \App\Models\GeneralSetting::first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Receipt #{{ $order->receipt_number }} - {{$gs->site_name}}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <meta name="description"
        content="Receipt with QR code for transaction verification - Download and print your {{$gs->site_name}} receipt" />

    <!-- Print-specific styles -->
    <style>
        /* Ensure print keeps design */
        @media print {
            body {
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                print-color-adjust: exact !important;
                background: white !important;
            }

            /* Page setup */
            @page {
                size: A4 portrait;
                /* Change to landscape if you want */
                margin: 15mm;
            }

            /* Hide buttons or non-print controls */
            .no-print {
                display: none !important;
            }

            /* Keep borders and shadows */
            .receipt-container,
            .receipt-info-card,
            .total-section,
            .bg-surface,
            .shadow-card,
            .shadow-modal {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
                background: inherit !important;
            }

            /* Force table borders */
            .receipt-table th,
            .receipt-table td {
                border: 1px solid #ccc !important;
            }

            /* Make QR code & logos print clearly */
            .qr-code-canvas,
            img {
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            /* Footer always at bottom */
            .receipt-footer {
                page-break-after: always;
            }
        }
    </style>


</head>

<body class="bg-secondary-50 text-text-primary">
    @php
        $shipping = $order->shippingAddress; // Assuming relation: Order belongsTo ShippingAddress
    @endphp
    <!-- Print Controls -->
    <div class="no-print bg-white shadow-card sticky top-0 z-50 border-b">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
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
                    <h1 class="text-lg font-semibold text-primary">
                        {{ $shipping->first_name . ' ' . $shipping->last_name }} Receipt</h1>
                </div>
                <div class="flex items-center space-x-3">

                    <button onclick="downloadReceiptPDF()" class="btn-primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Print Receipt
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Receipt Document -->
    <div class="min-h-screen py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="receipt-container bg-white shadow-modal rounded-lg overflow-hidden">
                <!-- Receipt Header -->
                <div class="receipt-header p-6">
                    <div class="grid lg:grid-cols-3 gap-6 items-start">
                        <!-- Company Logo & Info -->
                        <div class="lg:col-span-2">
                            <div class="flex items-center space-x-4 mb-6">
                                <img src="{{ $gs->logo }}" alt="{{$gs->site_name}} Logo"
                                    class="block rounded-lg" style="width:150px; height:100px; object-fit:cover;" />

                                <div>
                                    <h1 class="text-3xl font-bold" style="color:#FF6600;">{{$gs->site_name}}</h1>
                                    <p class="text-sm text-gray-600">Where Business Grows Together</p>
                                </div>
                            </div>

                            <div class="space-y-1 text-gray-700">
                                <p class="font-semibold">{{$gs->site_name}} Inc.</p>
                                <p>123 Commerce Drive, Suite 500</p>
                                <p>San Francisco, CA 94107, United States</p>
                                <p>Phone: +1 (555) 123-4567</p>
                                <p>Email: billing@tungamarket.com</p>
                            </div>
                        </div>

                        <!-- QR Code for Transaction Verification -->
                        <div class="qr-code-container text-center">
                            <div class="bg-surface p-4 rounded-lg border-2 border-accent-200">
                                <h3 class="text-sm font-semibold text-primary mb-3">Transaction Verification</h3>

                                <!-- Dynamic QR Code -->
                                <canvas id="qr-code" class="qr-code-canvas mx-auto" width="100" height="100"
                                    data-qrcode="{{ route('orders.show', $order->id) }}">
                                </canvas>

                                <p class="text-xs text-secondary-600 mt-2">Scan for digital receipt</p>
                                <p class="text-xs text-accent font-semibold">
                                    #{{ $order->payment->transaction_id ?? 'TXN-' . strtoupper(Str::random(8)) }}
                                </p>
                            </div>
                        </div>

                    </div>

                    <!-- Receipt Title & Status -->
                    <div class="flex items-center justify-between mt-6 pt-4 border-t border-secondary-200">
                        <div>
                            <h2 class="text-2xl font-bold text-primary">RECEIPT</h2>
                            <p class="text-secondary-600">Customer Transaction Record</p>
                        </div>
                        <div class="text-right">
                            <div
                                class="inline-flex items-center px-3 py-1 rounded-full bg-success-100 text-success-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm font-semibold">COMPLETED</span>
                            </div>
                            <p class="text-xs text-secondary-600 mt-1">
                                {{ $order->payment->paid_at ? $order->payment->paid_at->format('F d, Y') : '' }} -
                                {{ $order->payment->paid_at ? $order->payment->paid_at->format('g:i A') : '' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Receipt Details -->
                <div class="px-6 pb-6">
                    <div class="receipt-grid grid lg:grid-cols-2 gap-6 mb-6">
                        <!-- Transaction Info -->
                        <div class="receipt-info-card p-4 rounded-lg">
                            <h3 class="text-lg font-bold text-primary mb-3">Transaction Details</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Receipt Number:</span>
                                    <span class="font-semibold text-primary">{{ $order->receipt_number }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Order Number:</span>
                                    <span class="font-semibold text-primary">#
                                        {{ $order->items->first()->order_no }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Transaction ID:</span>
                                    <span class="font-semibold"> {{ $order->payment->transaction_id }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Date & Time:</span>
                                    <span
                                        class="font-semibold">{{ $order->payment->paid_at ? $order->payment->paid_at->format('M d, Y') : '' }}
                                        -
                                        {{ $order->payment->paid_at ? $order->payment->paid_at->format('g:i A') : '' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Payment Method:</span>
                                    <span class="font-semibold">{{ $order->payment->payment_method }}
                                        {{ $order->payment->masked_account ?? '' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Info -->
                        <div>
                            <h3 class="text-lg font-bold text-primary mb-3">Customer Information</h3>
                            <div class="space-y-1 text-secondary-700">
                                <p class="font-semibold text-primary">
                                    @if ($shipping->first_name && $shipping->last_name)
                                        {{ $shipping->first_name ?? '' }} {{ $shipping->last_name ?? '' }}
                                    @else
                                    @endif
                                </p>
                                <p class="font-semibold">
                                    @if ($shipping->company)
                                        {{ $shipping->company }}
                                    @else
                                    @endif
                                </p>
                                <p class="text-sm">Email: {{ $order->user->email ?? '' }}</p>
                                <p class="text-sm">Phone: {{ $shipping->phone ?? '' }}</p>
                            </div>

                            <div class="mt-4 pt-3 border-t border-secondary-200">
                                <h4 class="font-semibold text-primary mb-2">Billing Address</h4>
                                <div class="text-sm text-secondary-700 space-y-1">
                                    <p>{{ $shipping->address_line1 ?? '' }}</p>
                                    @if ($shipping->address_line2)
                                        <p>{{ $shipping->address_line2 ?? '' }}</p>
                                    @endif
                                    <p>{{ $shipping->city ?? '' }}, {{ $shipping->state ?? '' }}
                                        {{ $shipping->postal_code ?? '' }}</p>
                                    <p>{{ $shipping->country ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Items Purchased -->
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-primary mb-3">Items Purchased</h3>
                        <div class="overflow-x-auto">
                            <table class="receipt-table w-full border-collapse border border-secondary-200 text-sm">
                                <thead>
                                    <tr class="bg-surface">
                                        <th
                                            class="border border-secondary-200 px-3 py-2 text-left font-semibold text-primary">
                                            Description
                                        </th>
                                        <th
                                            class="border border-secondary-200 px-3 py-2 text-center font-semibold text-primary">
                                            Qty
                                        </th>
                                        <th
                                            class="border border-secondary-200 px-3 py-2 text-right font-semibold text-primary">
                                            Unit Price
                                        </th>
                                        <th
                                            class="border border-secondary-200 px-3 py-2 text-right font-semibold text-primary">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td class="border border-secondary-200 px-3 py-3">
                                                <div>
                                                    <p class="font-semibold text-primary">
                                                        {{ $item->product->name ?? '' }}</p>
                                                    <p class="text-xs text-secondary-600">SKU:
                                                        {{ $item->product->sku ?? '' }}</p>
                                                    @if (!empty($item->product->short_description))
                                                        <p class="text-xs text-secondary-600">
                                                            {{ Str::limit($item->product->short_description, 50) }}</p>
                                                    @endif
                                                </div>
                                            </td>
                                            <td
                                                class="border border-secondary-200 px-3 py-3 text-center font-semibold">
                                                {{ $item->quantity }}
                                            </td>
                                            <td class="border border-secondary-200 px-3 py-3 text-right font-semibold">
                                                {{ number_format($item->price) }} {{ $order->currency ?? 'RWF' }}
                                            </td>
                                            <td
                                                class="border border-secondary-200 px-3 py-3 text-right font-semibold text-accent">
                                                {{ number_format($item->price * $item->quantity) }}
                                                {{ $order->currency ?? 'RWF' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <!-- Payment Summary -->
                    <div class="grid lg:grid-cols-2 gap-6 mb-6">
                        <!-- Payment Details -->
                        <div>
                            <h3 class="text-lg font-semibold text-primary mb-3">Payment Details</h3>
                            <div class="bg-surface p-4 rounded-lg space-y-3">

                                <!-- Payment Method with Logo -->
                                <div class="flex items-center space-x-3 mb-3">
                                    @php
                                        $method = strtolower($order->payment->payment_method ?? 'other');
                                    @endphp

                                    @switch($method)
                                        @case('mtn momo')
                                            <img src="{{ asset('assets/images/mtn-momo.png') }}" alt="MTN MoMo"
                                                class="h-6">
                                        @break

                                        @case('airtel money')
                                            <img src="{{ asset('assets/images/airtel-money.png') }}" alt="Airtel Money"
                                                class="h-6">
                                        @break

                                        @case('visa')
                                            <img src="{{ asset('assets/images/visa.png') }}" alt="Visa" class="h-8">
                                        @break

                                        @case('mastercard')
                                            <img src="{{ asset('assets/images/mastercard.png') }}" alt="MasterCard"
                                                class="h-8">
                                        @break

                                        @case('irembopay')
                                            <img src="{{ asset('assets/images/irembopay.png') }}" alt="IremboPay"
                                                class="h-6">
                                        @break

                                        @default
                                            <svg class="w-8 h-6 text-primary" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4m0 4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                                            </svg>
                                    @endswitch

                                    <div>
                                        <p class="font-semibold text-primary">
                                            {{ $order->payment->payment_method ?? 'Unknown Method' }}
                                        </p>
                                        @if ($order->payment->masked_account)
                                            <p class="text-sm text-secondary-600">
                                                {{ $order->payment->masked_account }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Payment Metadata -->
                                <div class="border-t border-secondary-200 pt-3 space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-secondary-600">Transaction ID:</span>
                                        <span class="font-semibold">{{ $order->payment->transaction_id }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-secondary-600">Amount Paid:</span>
                                        <span class="font-semibold text-accent">
                                            {{ number_format($order->payment->amount, 2) }}
                                            {{ $order->payment->currency }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-secondary-600">Payment Gateway:</span>
                                        <span class="font-semibold">IremboPay</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-secondary-600">Paid At:</span>
                                        <span class="font-semibold">
                                            {{ $order->payment->paid_at ? $order->payment->paid_at->format('M d, Y H:i') : '—' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div
                                    class="mt-3 p-2
            @if ($order->payment->status === 'paid') bg-success-50 border border-success-200
            @elseif ($order->payment->status === 'pending')
                bg-warning-50 border border-warning-200
            @else
                bg-error-50 border border-error-200 @endif
            rounded">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4
                    @if ($order->payment->status === 'paid') text-success
                    @elseif ($order->payment->status === 'pending') text-warning
                    @else text-error @endif"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="@if ($order->payment->status === 'paid') M5 13l4 4L19 7
                             @elseif ($order->payment->status === 'pending')
                                M12 8v4m0 4h.01M12 20a8 8 0 100-16 8 8 0 000 16z
                             @else
                                M6 18L18 6M6 6l12 12 @endif" />
                                        </svg>
                                        <span
                                            class="font-semibold text-sm
                    @if ($order->payment->status === 'paid') text-success-700
                    @elseif ($order->payment->status === 'pending') text-warning-700
                    @else text-error-700 @endif">
                                            {{ strtoupper($order->payment->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Total Summary -->
                        <div>
                            <div class="total-section p-4">
                                <h3 class="text-lg font-semibold text-primary mb-3">Payment Summary</h3>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-secondary-700">Subtotal:</span>
                                        <span class="font-semibold">{{ number_format($subtotal) }}
                                            {{ $order->currency }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-secondary-700">Tax (10%):</span>
                                        <span class="font-semibold">{{ number_format($tax) }}
                                            {{ $order->currency }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-secondary-700">Shipping Fee:</span>
                                        <span class="font-semibold">
                                            <p class="text-success-600 text-sm mt-1">
                                                Free
                                            </p>
                                        </span>
                                    </div>
                                    <div class="border-t border-secondary-300 pt-2 mt-2">
                                        <div class="flex justify-between items-center">
                                            <span class="text-lg font-bold text-primary">Total Paid:</span>
                                            <span
                                                class="text-xl font-bold text-accent">{{ number_format($finalTotal) }}
                                                {{ $order->currency }}</span>
                                        </div>
                                        <div class="text-right text-xs text-secondary-600 mt-1">
                                            Rwf (Rwandan Francs)
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Confirmation -->
                                <div class="mt-3 text-center">
                                    <div class="inline-flex items-center px-4 py-2 bg-success text-white rounded-full">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="font-semibold">PAYMENT SUCCESSFUL</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="grid lg:grid-cols-2 gap-6">
                        <!-- Return Policy & Important Notes -->
                        <div>
                            <h3 class="text-lg font-semibold text-primary mb-3">Important Information</h3>
                            <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 text-sm space-y-2">
                                <div>
                                    <h4 class="font-semibold text-amber-800 mb-1">Return Policy</h4>
                                    <p class="text-amber-700">Items may be returned within 7 days of purchase in
                                        original condition. Return shipping costs apply unless item is defective.</p>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-amber-800 mb-1">Warranty</h4>
                                    <p class="text-amber-700">All products include manufacturer warranty. Extended
                                        warranty options are available.</p>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-amber-800 mb-1">Customer Service</h4>
                                    <p class="text-amber-700">For any questions about this transaction, contact us
                                        within 60 days of purchase.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Service -->
                        <div>
                            <h3 class="text-lg font-semibold text-primary mb-3">Customer Support</h3>
                            <div class="space-y-3">
                                <div class="bg-surface p-3 rounded-lg">
                                    <h4 class="font-semibold text-primary mb-2">General Support</h4>
                                    <div class="text-sm space-y-1">
                                        <p class="flex items-center"><span class="w-4 h-4 mr-2">📧</span>
                                            support@tungamarket.com</p>
                                        <p class="flex items-center"><span class="w-4 h-4 mr-2">📞</span> {{ $gs->site_phone }}</p>
                                        <p class="flex items-center"><span class="w-4 h-4 mr-2">🕒</span> Mon-Fri: 9
                                            AM - 6 PM PST</p>
                                        <p class="flex items-center"><span class="w-4 h-4 mr-2">💬</span> Live Chat:
                                            Available 24/7</p>
                                    </div>
                                </div>

                                <div class="bg-primary-50 p-3 rounded-lg border border-primary-200">
                                    <h4 class="font-semibold text-primary mb-2">Digital Receipt Access</h4>
                                    <p class="text-sm text-secondary-700 mb-2">Access your digital receipt anytime:</p>
                                    <p class="text-sm font-mono text-accent break-all">
                                        <a href="{{ url()->current() }}">{{ url()->current() }}</a>
                                    </p>
                                    <p class="text-xs text-secondary-600 mt-2">Or scan the QR code above</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Receipt Footer -->
                <div class="receipt-footer bg-secondary-800 text-white p-4">
                    <div class="grid md:grid-cols-3 gap-4 text-center md:text-left">
                        <div>
                            <p class="font-semibold mb-1">{{$gs->site_name}} Ltd.</p>
                            <p class="text-secondary-300 text-sm">Rwanda's Premier Online Marketplace</p>
                            <p class="text-secondary-300 text-xs">Est. 2025 • Kigali, Rwanda</p>
                        </div>
                        <div>
                            <p class="font-semibold mb-1">Thank You for Your Purchase!</p>
                            <p class="text-secondary-300 text-sm">Your business means the world to us</p>
                            <p class="text-secondary-300 text-sm">Where Business Grows Together</p>
                        </div>
                        <div>
                            <p class="font-semibold mb-1">Need Help?</p>
                            <p class="text-secondary-300 text-sm">support@tungamarket.com</p>
                            <p class="text-secondary-300 text-sm">{{ $gs->site_phone }}</p>
                        </div>
                    </div>
                    <div class="border-t border-secondary-700 mt-6 pt-4 text-center">
                        <p class="text-secondary-400 text-sm invoice-time" id="receipt-generated-time">
                            This Receipt was generated on {{ now()->format('F d, Y') }} at {{ now()->format('H:m') }}
                            UTC •
                            Invoice ID: {{ $order->invoice_number }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
    <!-- Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const canvas = document.getElementById("qr-code");
            if (canvas) {
                const qrData = canvas.dataset.qrcode;
                QRCode.toCanvas(canvas, qrData, function(error) {
                    if (error) console.error(error);
                });
            }
        });

        function downloadReceiptPDF() {
            window.print();
        }

         document.addEventListener("DOMContentLoaded", () => {
        const el = document.getElementById("receipt-generated-time");
        if (!el) return;

        const now = new Date();

        // 🕒 Format date and time in user’s local format
        const date = now.toLocaleDateString(undefined, {
            year: "numeric",
            month: "long",
            day: "2-digit",
        });
        const time = now.toLocaleTimeString(undefined, {
            hour: "2-digit",
            minute: "2-digit",
        });

        // 🌍 Get timezone offset in hours (e.g. +2, -5, etc.)
        const offsetMinutes = now.getTimezoneOffset();
        const offsetHours = Math.floor(Math.abs(offsetMinutes) / 60);
        const offsetMins = Math.abs(offsetMinutes) % 60;
        const sign = offsetMinutes <= 0 ? '+' : '-';

        const formattedOffset = `GMT${sign}${String(offsetHours).padStart(2, '0')}:${String(offsetMins).padStart(2, '0')}`;

        // 🧭 Optionally, detect a short timezone name like "PST", "CEST"
        const tzName = Intl.DateTimeFormat('en', { timeZoneName: 'short' })
            .formatToParts(now)
            .find(part => part.type === 'timeZoneName')?.value || formattedOffset;

        // 🪄 Update text dynamically
        el.textContent = `This receipt was generated on ${date} at ${time} ${tzName}`;
    });


    </script>

</body>

</html>
