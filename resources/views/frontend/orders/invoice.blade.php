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
                                    <span class="font-semibold text-primary">INV-2025-789456</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Order Number:</span>
                                    <span class="font-semibold text-primary">#AM2025-789456</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Invoice Date:</span>
                                    <span class="font-semibold">January 26, 2025</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Due Date:</span>
                                    <span class="font-semibold">February 25, 2025</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Payment Method:</span>
                                    <span class="font-semibold">Credit Card •••• 4532</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Currency:</span>
                                    <span class="font-semibold">USD ($)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bill To -->
                        <div>
                            <h2 class="text-xl font-bold text-primary mb-4">Bill To</h2>
                            <div class="space-y-1 text-secondary-700">
                                <p class="font-semibold text-primary">John Smith</p>
                                <p class="font-semibold">TechStart Solutions</p>
                                <p>123 Business Park Drive</p>
                                <p>Suite 200</p>
                                <p>San Francisco, CA 94107</p>
                                <p>United States</p>
                                <p class="mt-3 font-semibold">Contact Information:</p>
                                <p>Email: john.smith@techstart.com</p>
                                <p>Phone: +1 (555) 123-4567</p>
                                <p>Tax ID: 98-7654321</p>
                            </div>
                        </div>

                        <!-- Ship To -->
                        <div>
                            <h2 class="text-xl font-bold text-primary mb-4">Ship To</h2>
                            <div class="space-y-1 text-secondary-700">
                                <p class="font-semibold text-primary">TechStart Solutions</p>
                                <p>Warehouse Reception</p>
                                <p>123 Business Park Drive</p>
                                <p>Suite 200</p>
                                <p>San Francisco, CA 94107</p>
                                <p>United States</p>
                                <p class="mt-3 font-semibold">Delivery Instructions:</p>
                                <p>Business hours: 9 AM - 6 PM</p>
                                <p>Loading dock available</p>
                                <p>Contact: Building Security</p>
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
                                            Tax Rate</th>
                                        <th
                                            class="border border-secondary-200 px-4 py-3 text-right text-sm font-semibold text-primary">
                                            Line Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-secondary-200 px-4 py-4">
                                            <div>
                                                <p class="font-semibold text-primary">Premium Wireless Earbuds Pro</p>
                                                <p class="text-sm text-secondary-600">Model: PWE-2025-PRO</p>
                                                <p class="text-sm text-secondary-600">SKU: TechSound-PWE-001</p>
                                                <p class="text-sm text-secondary-600">Bluetooth 5.3, Noise Cancellation
                                                </p>
                                            </div>
                                        </td>
                                        <td class="border border-secondary-200 px-4 py-4">
                                            <div>
                                                <p class="font-semibold text-primary">TechSound Electronics</p>
                                                <p class="text-sm text-secondary-600">Verified Supplier</p>
                                                <p class="text-sm text-secondary-600">Shenzhen, China</p>
                                            </div>
                                        </td>
                                        <td class="border border-secondary-200 px-4 py-4 text-center font-semibold">50
                                        </td>
                                        <td class="border border-secondary-200 px-4 py-4 text-right font-semibold">
                                            $45.50</td>
                                        <td class="border border-secondary-200 px-4 py-4 text-right">8.5%</td>
                                        <td
                                            class="border border-secondary-200 px-4 py-4 text-right font-semibold text-accent">
                                            $2,275.00</td>
                                    </tr>

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
                                        <p><span class="text-secondary-600">Method:</span> Credit Card (Visa)</p>
                                        <p><span class="text-secondary-600">Card Number:</span> •••• •••• •••• 4532</p>
                                        <p><span class="text-secondary-600">Transaction ID:</span> TXN-789456-2025</p>
                                        <p><span class="text-secondary-600">Authorization:</span> AUTH-987654</p>
                                        <div class="mt-2 flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-success" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-success font-semibold text-sm">Payment Verified</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-surface p-4 rounded-lg">
                                    <h4 class="font-semibold text-primary mb-2">Shipping Information</h4>
                                    <div class="space-y-1 text-sm">
                                        <p><span class="text-secondary-600">Method:</span> Express International</p>
                                        <p><span class="text-secondary-600">Carrier:</span> DHL Express</p>
                                        <p><span class="text-secondary-600">Service:</span> Door-to-Door</p>
                                        <p><span class="text-secondary-600">Estimated Delivery:</span> Feb 2-5, 2025
                                        </p>
                                        <p><span class="text-secondary-600">Tracking Number:</span> TRK789456123</p>
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
                                        <span class="font-semibold">$2,847.50</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-secondary-700">Tax (8.5%):</span>
                                        <span class="font-semibold">$242.04</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-secondary-700">Shipping & Handling:</span>
                                        <span class="font-semibold">$125.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-secondary-700">Insurance:</span>
                                        <span class="font-semibold">$15.50</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-secondary-600">Processing Fee:</span>
                                        <span class="font-semibold">$8.50</span>
                                    </div>
                                    <div class="border-t border-secondary-300 pt-3">
                                        <div class="flex justify-between items-center">
                                            <span class="text-xl font-bold text-primary">Total Amount:</span>
                                            <span class="text-2xl font-bold text-accent">$3,238.54</span>
                                        </div>
                                        <div class="text-right text-sm text-secondary-600 mt-1">
                                            USD (United States Dollar)
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Status -->
                                <div class="mt-4 p-3 bg-success-50 border border-success-200 rounded-lg">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="font-semibold text-success-700">PAID IN FULL</span>
                                    </div>
                                    <p class="text-success-600 text-sm mt-1">Payment received on January 26, 2025</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="grid lg:grid-cols-2 gap-8">
                        <!-- Terms & Conditions -->
                        <div>
                            <h3 class="text-lg font-semibold text-primary mb-4">Terms & Conditions</h3>
                            <div class="text-sm text-secondary-700 space-y-2">
                                <p><strong>Payment Terms:</strong> Payment is due within 30 days of invoice date. Late
                                    payments may incur additional charges as per our terms of service.</p>
                                <p><strong>Returns:</strong> Items may be returned within 30 days of delivery in
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
                                        <p>🕒 Mon-Fri: 9 AM - 6 PM PST</p>
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
                                    <p class="text-sm font-mono text-primary break-all">
                                        https://tungamarket.com/track/AM2025-789456</p>
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
