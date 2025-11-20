@php
    $gs = \App\Models\GeneralSetting::first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice #{{ $order->invoice_number }} - {{$gs->site_name}}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <meta name="description"
        content="Invoice with QR code for order tracking - Download and print your {{$gs->site_name}} invoice" />


    <style>
        /* Ensure print keeps design */
        @media print {
            body {
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                print-color-adjust: exact !important;
                background: white !important;
            }

            /* Landscape layout */
            @page {
                size: A4 portrait;
                margin: 15mm;
            }

            /* Hide non-print controls */
            .no-print {
                display: none !important;
            }

            /* Keep shadows and borders */
            .shadow-card,
            .shadow-modal {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }
        }
    </style>


</head>
@if (request()->has('autoPrint'))
    <script>
        window.onload = function () {
            window.print();

            // Close tab automatically after print finishes
            window.onafterprint = function () {
                window.close();
            };
        }
    </script>
@endif


<body class="bg-secondary-50 text-text-primary">
    @php
        $shipping = $order->shippingAddress; // Assuming relation: Order belongsTo ShippingAddress
    @endphp
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
                    <h1 class="text-lg font-semibold text-primary">
                        {{ $shipping->first_name . ' ' . $shipping->last_name }} Invoice
                    </h1>
                </div>
                <div class="flex items-center space-x-3">

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
            <div id="invoice-container" class="invoice-container bg-white shadow-modal rounded-lg overflow-hidden">
                <!-- Invoice Header -->
                <div class="invoice-header p-8">
                    <div class="grid lg:grid-cols-3 gap-8 items-start">
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
                                <p>Tax ID: 12-3456789</p>
                            </div>
                        </div>

                        <!-- QR Code for Order Tracking -->
                        <div class="qr-code-container text-center">
                            <div class="bg-surface p-4 rounded-lg border-2" style="border-color: #E6EEF6;">
                                <h3 class="text-sm font-semibold" style="color:#001327;">Quick Order Tracking</h3>
                                <div class="mx-auto my-3" style="width:120px; height:120px;">
                                    {!! QrCode::size(120)->margin(0)->generate(route('orders.show', $order->id)) !!}
                                </div>

                                <p class="text-xs text-gray-500 mt-2">Scan to view order details</p>
                                @php
                                    $trackingRef =
                                        'AM' .
                                        now()->format('Y') .
                                        '-' .
                                        str_pad($order->id ?? 0, 6, '0', STR_PAD_LEFT);
                                @endphp
                                <p class="text-xs font-semibold" style="color:#FF6600;">
                                    {{ $order->invoice_number ?? $trackingRef }}
                                </p>
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
                                    <span class="font-semibold text-primary">{{ $order->invoice_number ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Order Number:</span>
                                    <span
                                        class="font-semibold text-primary">#{{ $order->items->first()->order_no }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Invoice Date:</span>
                                    <span class="font-semibold">{{ $order->created_at->format('F d, Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Due Date:</span>
                                    <span
                                        class="font-semibold">{{ $order->created_at->addDays(30)->format('F d, Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Payment Method:</span>
                                    <span class="font-semibold">{{ $order->payment_method }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Currency:</span>
                                    <span class="font-semibold">{{ $order->currency }}</span>
                                </div>
                            </div>
                        </div>




                        <!-- Bill To -->
                        <div>
                            <h2 class="text-xl font-bold text-primary mb-4">Bill To</h2>
                            <div class="space-y-1 text-secondary-700">
                                <p class="font-semibold text-primary">{{ $shipping->first_name }}
                                    {{ $shipping->last_name }}
                                </p>
                                @if ($shipping->company)
                                    <p class="font-semibold">{{ $shipping->company }}</p>
                                @endif
                                <p>{{ $shipping->address_line1 }}</p>
                                @if ($shipping->address_line2)
                                    <p>{{ $shipping->address_line2 }}</p>
                                @endif
                                <p>{{ $shipping->city }}, {{ $shipping->state }} {{ $shipping->postal_code }}</p>
                                <p>{{ $shipping->country }}</p>

                                <p class="mt-3 font-semibold">Contact Information:</p>
                                <p>Email: {{ $order->user->email ?? '' }}</p>
                                <p>Phone: {{ $shipping->phone }}</p>
                            </div>
                        </div>

                        <!-- Ship To -->
                        <div>
                            <h2 class="text-xl font-bold text-primary mb-4">Ship To</h2>
                            <div class="space-y-1 text-secondary-700">
                                <p class="font-semibold text-primary">
                                    {{ $shipping->company ?? $shipping->first_name . ' ' . $shipping->last_name }}
                                </p>
                                <p>{{ $shipping->address_line1 }}</p>
                                @if ($shipping->address_line2)
                                    <p>{{ $shipping->address_line2 }}</p>
                                @endif
                                <p>{{ $shipping->city }}, {{ $shipping->state }} {{ $shipping->postal_code }}</p>
                                <p>{{ $shipping->country }}</p>

                                <p class="mt-3 font-semibold">Delivery Instructions:</p>
                                <p class="text-secondary-600 italic">No delivery instructions provided</p>
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
                                        <th
                                            class="border border-secondary-200 px-4 py-3 text-left text-sm font-semibold text-primary">
                                            Description</th>
                                        <th
                                            class="border border-secondary-200 px-4 py-3 text-left text-sm font-semibold text-primary">
                                            Supplier</th>
                                        <th
                                            class="border border-secondary-200 px-4 py-3 text-center text-sm font-semibold text-primary">
                                            Qty</th>
                                        <th
                                            class="border border-secondary-200 px-4 py-3 text-right text-sm font-semibold text-primary">
                                            Unit Price</th>
                                        <th
                                            class="border border-secondary-200 px-4 py-3 text-right text-sm font-semibold text-primary">
                                            Line Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td class="border px-4 py-4">
                                                <p class="font-semibold text-primary">{{ $item->product->name }}</p>
                                                <p class="text-sm text-secondary-600">SKU: {{ $item->product->sku }}
                                                </p>
                                                <p class="text-sm text-secondary-600">Qty: {{ $item->quantity }}</p>
                                            </td>
                                            <td class="border px-4 py-4">
                                                <p class="font-semibold text-primary">
                                                    {{ $item->product->brand->name ?? '{{$gs->site_name}} Inc.' }}
                                                </p>
                                            </td>
                                            <td class="border px-4 py-4 text-center font-semibold">
                                                {{ $item->quantity }}
                                            </td>
                                            <td class="border px-4 py-4 text-right font-semibold">
                                                {{ $item->price }} {{ $order->currency }}
                                            </td>
                                            <td class="border px-4 py-4 text-right font-semibold text-accent">
                                                {{ number_format($item->price * $item->quantity) }}
                                                {{ $order->currency }}
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
                                <!-- Payment Info -->
                                <div class="bg-surface p-4 rounded-lg">
                                    <h4 class="font-semibold text-primary mb-2">Payment Information</h4>
                                    @if ($order->payment)
                                        <div class="space-y-1 text-sm">
                                            <p><span class="text-secondary-600">Method:</span>
                                                {{ $order->payment->payment_method }}</p>
                                            <p><span class="text-secondary-600">Account/Card:</span>
                                                {{ $order->payment->masked_account ?? '' }}</p>
                                            <p><span class="text-secondary-600">Transaction ID:</span>
                                                {{ $order->payment->transaction_id }}</p>
                                            <p><span class="text-secondary-600">Amount:</span>
                                                {{ number_format($order->payment->amount) }}
                                                {{ $order->payment->currency }}
                                            </p>

                                            @if ($order->payment->status === 'paid')
                                                <div class="mt-2 flex items-center space-x-2">
                                                    <svg class="w-4 h-4 text-success" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    <span class="text-success font-semibold text-sm">Payment
                                                        Verified</span>
                                                </div>
                                            @else
                                                <div class="mt-2 flex items-center space-x-2">
                                                    <svg class="w-4 h-4 text-warning" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 8v4m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                                                    </svg>
                                                    <span class="text-warning font-semibold text-sm">Payment
                                                        {{ ucfirst($order->payment->status) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <p class="text-secondary-600 text-sm">No payment details available.</p>
                                    @endif
                                </div>

                                <!-- Shipping Info -->
                                <div class="bg-surface p-4 rounded-lg">
                                    <h4 class="font-semibold text-primary mb-2">Shipping Information</h4>
                                    @if ($order->shippingAddress)
                                        <div class="space-y-1 text-sm">
                                            <p><span class="text-secondary-600">Recipient:</span>
                                                {{ $order->shippingAddress->first_name }}
                                                {{ $order->shippingAddress->last_name }}
                                            </p>
                                            <p><span class="text-secondary-600">Address:</span>
                                                {{ $order->shippingAddress->address_line1 }}
                                                {{ $order->shippingAddress->address_line2 ? ', ' . $order->shippingAddress->address_line2 : '' }},
                                                {{ $order->shippingAddress->city }},
                                                {{ $order->shippingAddress->state }} -
                                                {{ $order->shippingAddress->postal_code }}
                                            </p>
                                            <p><span class="text-secondary-600">Country:</span>
                                                {{ $order->shippingAddress->country }}</p>
                                            <p><span class="text-secondary-600">Phone:</span>
                                                {{ $order->shippingAddress->phone }}</p>
                                        </div>
                                    @else
                                        <p class="text-secondary-600 text-sm">No shipping details available.</p>
                                    @endif
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
                                        <span class="font-semibold">{{ number_format($subtotal) }}
                                            {{ $order->currency }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-secondary-700">Tax (10%):</span>
                                        <span class="font-semibold">{{ number_format($tax) }}
                                            {{ $order->currency }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-secondary-700">Shipping:</span>
                                        <span class="font-semibold">
                                            <p class="text-success-600 text-sm mt-1">
                                                Free
                                            </p>
                                        </span>
                                    </div>
                                    <div class="border-t border-secondary-300 pt-3">
                                        <div class="flex justify-between items-center">
                                            <span class="text-xl font-bold text-primary">Total Amount:</span>
                                            <span
                                                class="text-2xl font-bold text-accent">{{ number_format($finalTotal) }}
                                                {{ $order->currency }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Status -->
                                @if ($order->payment && $order->payment->status === 'paid')
                                    <div class="mt-4 p-3 bg-success-50 border border-success-200 rounded-lg">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="font-semibold text-success-700">PAID IN FULL</span>
                                        </div>
                                        <p class="text-success-600 text-sm mt-1">
                                            Payment received on
                                            {{ $order->payment->paid_at ? $order->payment->paid_at->format('F d, Y') : '' }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>


                    <!-- Additional Information -->
                    <div class="grid lg:grid-cols-2 gap-8">
                        <!-- Terms & Conditions -->
                        <div>
                            <h3 class="text-lg font-semibold text-primary mb-4">Terms & Conditions</h3>
                            <div class="text-sm text-secondary-700 space-y-2">
                                <p><strong>Payment Terms:</strong> Payment is due within 7 days of invoice date. Late
                                    payments may incur additional charges as per our terms of service.</p>
                                <p><strong>Returns:</strong> Items may be returned within 7 days of delivery in
                                    original condition. Return shipping costs apply unless item is defective.</p>
                                <p><strong>Warranty:</strong> All products come with manufacturer warranty as specified
                                    in product documentation. Extended warranty options available.</p>
                                <p><strong>Disputes:</strong> Any disputes regarding this invoice should be reported
                                    within 60 days. Contact our billing department for resolution.</p>
                                <p><strong>Jurisdiction:</strong> This invoice is governed by the laws of California,
                                    United States.</p>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div>
                            <h3 class="text-lg font-semibold text-primary mb-4">Support & Contact</h3>
                            <div class="space-y-4">
                                <div class="bg-surface p-4 rounded-lg">
                                    <h4 class="font-semibold text-primary mb-2">Billing Inquiries</h4>
                                    <div class="text-sm space-y-1">
                                        <p>📧 billing@tungamarket.com</p>
                                        <p>📞 +1 (555) 123-4567 ext. 101</p>
                                        <p>🕒 Mon-Fri: 9 AM - 6 PM GMT +2</p>
                                    </div>
                                </div>

                                <div class="bg-surface p-4 rounded-lg">
                                    <h4 class="font-semibold text-primary mb-2">Order Support</h4>
                                    <div class="text-sm space-y-1">
                                        <p>📧 orders@tungamarket.com</p>
                                        <p>📞 +1 (555) 123-4567 ext. 102</p>
                                        <p>💬 Live Chat: Available 24/7</p>
                                    </div>
                                </div>

                                <div class="bg-primary-50 p-4 rounded-lg border border-primary-200">
                                    <h4 class="font-semibold text-primary mb-2">Track Your Order</h4>
                                    <p class="text-sm text-secondary-700 mb-2">Scan the QR code above or visit:</p>
                                    <p class="text-sm font-mono text-accent break-all">
                                        <a href="{{ url()->current() }}">{{ url()->current() }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Invoice Footer -->
                <div class="footer bg-secondary-800 text-white p-6">
                    <div class="grid md:grid-cols-3 gap-6 text-center md:text-left">
                        <div>
                            <p class="font-semibold mb-1">{{$gs->site_name}} Ltd.</p>
                            <p class="text-secondary-300 text-sm">Rwanda's Premier Online Marketplace</p>
                            <p class="text-secondary-300 text-xs">Est. 2025 • Kigali, Rwanda</p>
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
                        <p class="text-secondary-400 text-sm invoice-time" id="invoice-generated-time">
                            This invoice was generated on {{ now()->format('F d, Y') }} at {{ now()->format('H:m') }}
                            UTC •
                            Invoice ID: {{ $order->invoice_number }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

<script>
    function downloadInvoicePDF() {
        window.print();
    }
    document.addEventListener("DOMContentLoaded", () => {
        const el = document.getElementById("invoice-generated-time");
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
        el.textContent = `This invoice was generated on ${date} at ${time} ${tzName}`;
    });



</script>

</html>