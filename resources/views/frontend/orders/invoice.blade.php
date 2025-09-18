<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice - Tunga Market</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <meta name="description" content="Professional invoice template with QR code for order tracking - Download and print your Tunga Market invoice" />

    <!-- Print-specific styles -->
    <style>
        @media print {
            body { margin: 0; padding: 0; background: white !important; }
            .no-print { display: none !important; }
            .invoice-container { box-shadow: none !important; margin: 0 !important; }
            .qr-code-container { page-break-inside: avoid; }
            .footer { page-break-inside: avoid; }
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
            .invoice-grid { grid-template-columns: 1fr !important; }
            .qr-code-container { text-align: center; margin-top: 1rem; }
        }
    </style>
<script type="module" src="https://static.rocket.new/rocket-web.js?_cfg=https%3A%2F%2Falimaxcom1831back.builtwithrocket.new&_be=https%3A%2F%2Fapplication.rocket.new&_v=0.1.8"></script>
</head>
<body class="bg-secondary-50 text-text-primary">
    <!-- Print Controls -->
    <div class="no-print bg-white shadow-card sticky top-0 z-50 border-b">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">

                <div class="flex items-center space-x-3">
                    <button onclick="downloadPDF()" class="btn-secondary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download PDF
                    </button>
                    <button onclick="window.print()" class="btn-primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
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
                <div class="invoice-header p-8">
                    <div class="grid lg:grid-cols-3 gap-8 items-start">
                        <!-- Company Logo & Info -->
                        <div class="lg:col-span-2">
                            <div class="flex items-center space-x-4 mb-6">
                                <img src="{{ asset('assets/images/logo.png') }}"
                            style="width: 80px; height: 40px; border-radius: 8px; object-fit: cover;"
                            alt="Tunga Market Logo" class="Imglogo text-primary" />
                                <div>
                                    <h1 class="text-3xl font-bold text-primary">AliMax Commerce</h1>
                                    <p class="text-secondary-600">Where Business Grows Together</p>
                                </div>
                            </div>
                            <div class="space-y-1 text-secondary-700">
                                <p class="font-semibold">AliMax Commerce Inc.</p>
                                <p>123 Commerce Drive, Suite 500</p>
                                <p>San Francisco, CA 94107, United States</p>
                                <p>Phone: +1 (555) 123-4567</p>
                                <p>Email: billing@alimaxcommerce.com</p>
                                <p>Tax ID: 12-3456789</p>
                            </div>
                        </div>

                        <!-- QR Code for Order Tracking -->
                        <div class="qr-code-container text-center">
                            <div class="bg-surface p-4 rounded-lg border-2 border-accent-200">
                                <h3 class="text-sm font-semibold text-primary mb-3">Quick Order Tracking</h3>
                                <canvas id="qr-code" class="qr-code-canvas mx-auto" width="120" height="120"></canvas>
                                <p class="text-xs text-secondary-600 mt-2">Scan to track your order</p>
                                <p class="text-xs text-accent font-semibold">#AM2025-789456</p>
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
                                        <th class="border border-secondary-200 px-4 py-3 text-left text-sm font-semibold text-primary">Description</th>
                                        <th class="border border-secondary-200 px-4 py-3 text-left text-sm font-semibold text-primary">Supplier</th>
                                        <th class="border border-secondary-200 px-4 py-3 text-center text-sm font-semibold text-primary">Qty</th>
                                        <th class="border border-secondary-200 px-4 py-3 text-right text-sm font-semibold text-primary">Unit Price</th>
                                        <th class="border border-secondary-200 px-4 py-3 text-right text-sm font-semibold text-primary">Tax Rate</th>
                                        <th class="border border-secondary-200 px-4 py-3 text-right text-sm font-semibold text-primary">Line Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-secondary-200 px-4 py-4">
                                            <div>
                                                <p class="font-semibold text-primary">Premium Wireless Earbuds Pro</p>
                                                <p class="text-sm text-secondary-600">Model: PWE-2025-PRO</p>
                                                <p class="text-sm text-secondary-600">SKU: TechSound-PWE-001</p>
                                                <p class="text-sm text-secondary-600">Bluetooth 5.3, Noise Cancellation</p>
                                            </div>
                                        </td>
                                        <td class="border border-secondary-200 px-4 py-4">
                                            <div>
                                                <p class="font-semibold text-primary">TechSound Electronics</p>
                                                <p class="text-sm text-secondary-600">Verified Supplier</p>
                                                <p class="text-sm text-secondary-600">Shenzhen, China</p>
                                            </div>
                                        </td>
                                        <td class="border border-secondary-200 px-4 py-4 text-center font-semibold">50</td>
                                        <td class="border border-secondary-200 px-4 py-4 text-right font-semibold">$45.50</td>
                                        <td class="border border-secondary-200 px-4 py-4 text-right">8.5%</td>
                                        <td class="border border-secondary-200 px-4 py-4 text-right font-semibold text-accent">$2,275.00</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-secondary-200 px-4 py-4">
                                            <div>
                                                <p class="font-semibold text-primary">Smart Home Hub Controller</p>
                                                <p class="text-sm text-secondary-600">Model: SHH-2025-CTRL</p>
                                                <p class="text-sm text-secondary-600">SKU: HomeAuto-SHH-025</p>
                                                <p class="text-sm text-secondary-600">WiFi 6, Zigbee 3.0, Voice Control</p>
                                            </div>
                                        </td>
                                        <td class="border border-secondary-200 px-4 py-4">
                                            <div>
                                                <p class="font-semibold text-primary">HomeAutomation Co.</p>
                                                <p class="text-sm text-secondary-600">Premium Supplier</p>
                                                <p class="text-sm text-secondary-600">Dongguan, China</p>
                                            </div>
                                        </td>
                                        <td class="border border-secondary-200 px-4 py-4 text-center font-semibold">25</td>
                                        <td class="border border-secondary-200 px-4 py-4 text-right font-semibold">$22.90</td>
                                        <td class="border border-secondary-200 px-4 py-4 text-right">8.5%</td>
                                        <td class="border border-secondary-200 px-4 py-4 text-right font-semibold text-accent">$572.50</td>
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
                                            <svg class="w-4 h-4 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
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
                                        <p><span class="text-secondary-600">Estimated Delivery:</span> Feb 2-5, 2025</p>
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
                                        <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
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
                                <p><strong>Payment Terms:</strong> Payment is due within 30 days of invoice date. Late payments may incur additional charges as per our terms of service.</p>
                                <p><strong>Returns:</strong> Items may be returned within 30 days of delivery in original condition. Return shipping costs apply unless item is defective.</p>
                                <p><strong>Warranty:</strong> All products come with manufacturer warranty as specified in product documentation. Extended warranty options available.</p>
                                <p><strong>Disputes:</strong> Any disputes regarding this invoice should be reported within 60 days. Contact our billing department for resolution.</p>
                                <p><strong>Jurisdiction:</strong> This invoice is governed by the laws of California, United States.</p>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div>
                            <h3 class="text-lg font-semibold text-primary mb-4">Support & Contact</h3>
                            <div class="space-y-4">
                                <div class="bg-surface p-4 rounded-lg">
                                    <h4 class="font-semibold text-primary mb-2">Billing Inquiries</h4>
                                    <div class="text-sm space-y-1">
                                        <p>📧 billing@alimaxcommerce.com</p>
                                        <p>📞 +1 (555) 123-4567 ext. 101</p>
                                        <p>🕒 Mon-Fri: 9 AM - 6 PM PST</p>
                                    </div>
                                </div>

                                <div class="bg-surface p-4 rounded-lg">
                                    <h4 class="font-semibold text-primary mb-2">Order Support</h4>
                                    <div class="text-sm space-y-1">
                                        <p>📧 orders@alimaxcommerce.com</p>
                                        <p>📞 +1 (555) 123-4567 ext. 102</p>
                                        <p>💬 Live Chat: Available 24/7</p>
                                    </div>
                                </div>

                                <div class="bg-primary-50 p-4 rounded-lg border border-primary-200">
                                    <h4 class="font-semibold text-primary mb-2">Track Your Order</h4>
                                    <p class="text-sm text-secondary-700 mb-2">Scan the QR code above or visit:</p>
                                    <p class="text-sm font-mono text-primary break-all">https://alimaxcommerce.com/track/AM2025-789456</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Invoice Footer -->
                <div class="footer bg-secondary-800 text-white p-6">
                    <div class="grid md:grid-cols-3 gap-6 text-center md:text-left">
                        <div>
                            <p class="font-semibold mb-2">AliMax Commerce Inc.</p>
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
                            <p class="text-secondary-300 text-sm">support@alimaxcommerce.com</p>
                            <p class="text-secondary-300 text-sm">+1 (555) 123-4567</p>
                        </div>
                    </div>
                    <div class="border-t border-secondary-700 mt-6 pt-4 text-center">
                        <p class="text-secondary-400 text-sm">
                            This invoice was generated on January 26, 2025 at 16:19 UTC •
                            Invoice ID: INV-2025-789456 •
                            For authentication, verify at: verify.alimaxcommerce.com
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // QR Code Generation (Simple implementation)
        function generateQRCode() {
            const canvas = document.getElementById('qr-code');
            const ctx = canvas.getContext('2d');

            // Clear canvas
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, 120, 120);

            // Simple QR code pattern (in real implementation, use a proper QR code library)
            const qrData = 'https://alimaxcommerce.com/track/AM2025-789456';

            // Create a simple grid pattern to simulate QR code
            ctx.fillStyle = '#000000';
            const cellSize = 4;
            const margin = 8;

            // Generate a pseudo-random pattern based on the order number
            const orderNum = 'AM2025-789456';
            let seed = 0;
            for (let i = 0; i < orderNum.length; i++) {
                seed += orderNum.charCodeAt(i);
            }

            // Simple pseudo-random number generator
            function pseudoRandom(seed) {
                return ((seed * 9301 + 49297) % 233280) / 233280;
            }

            // Draw QR-like pattern
            for (let y = 0; y < 26; y++) {
                for (let x = 0; x < 26; x++) {
                    seed++;
                    if (pseudoRandom(seed) > 0.5) {
                        ctx.fillRect(
                            margin + x * cellSize,
                            margin + y * cellSize,
                            cellSize,
                            cellSize
                        );
                    }
                }
            }

            // Draw finder patterns (corners)
            const corners = [[0, 0], [0, 20], [20, 0]];
            corners.forEach(([cornerX, cornerY]) => {
                // Outer square
                ctx.fillRect(margin + cornerX * cellSize, margin + cornerY * cellSize, cellSize * 6, cellSize * 6);
                // Inner white square
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(margin + (cornerX + 1) * cellSize, margin + (cornerY + 1) * cellSize, cellSize * 4, cellSize * 4);
                // Inner black square
                ctx.fillStyle = '#000000';
                ctx.fillRect(margin + (cornerX + 2) * cellSize, margin + (cornerY + 2) * cellSize, cellSize * 2, cellSize * 2);
            });

            // Add click handler for QR code
            canvas.style.cursor = 'pointer';
            canvas.addEventListener('click', function() {
                openTrackingPage();
            });
        }

        // Open tracking page when QR code is clicked
        function openTrackingPage() {
            // In a real implementation, this would open the actual tracking page
            alert('QR Code Scanned!\n\nRedirecting to order tracking...\n\nOrder: #AM2025-789456\nStatus: Processing\nExpected Delivery: Feb 2-5, 2025');

            // Simulate opening tracking page
            const trackingUrl = 'order_confirmation_tracking.html#AM2025-789456';
            if (window.opener) {
                window.opener.location.href = trackingUrl;
                window.close();
            } else {
                window.location.href = trackingUrl;
            }
        }

        // Download PDF functionality
        function downloadPDF() {
            // Show download message
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 bg-success text-white p-4 rounded-lg shadow-lg z-50 transition-all duration-300';
            notification.innerHTML = `
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <div class="font-semibold">PDF Downloaded Successfully!</div>
                        <div class="text-sm opacity-90">Invoice INV-2025-789456.pdf</div>
                    </div>
                </div>
            `;
            document.body.appendChild(notification);

            // Remove notification after 3 seconds
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);

            // In a real implementation, this would generate and download actual PDF
            console.log('Downloading PDF: INV-2025-789456.pdf');
        }

        // Print optimization
        function optimizeForPrint() {
            // Add print-specific optimizations
            const style = document.createElement('style');
            style.textContent = `
                @media print {
                    * { -webkit-print-color-adjust: exact; }
                    .invoice-container { box-shadow: none !important; }
                    .qr-code-canvas { border: 1px solid #000 !important; }
                }
            `;
            document.head.appendChild(style);
        }

        // Initialize invoice
        document.addEventListener('DOMContentLoaded', function() {
            generateQRCode();
            optimizeForPrint();

            // Add mobile responsiveness for QR code
            function handleResize() {
                const qrContainer = document.querySelector('.qr-code-container');
                if (window.innerWidth < 768) {
                    qrContainer.classList.add('text-center', 'mt-4');
                } else {
                    qrContainer.classList.remove('mt-4');
                }
            }

            window.addEventListener('resize', handleResize);
            handleResize();
        });

        // Handle print button
        window.addEventListener('beforeprint', function() {
            // Optimize QR code for printing
            const canvas = document.getElementById('qr-code');
            canvas.style.border = '2px solid #000';
        });

        window.addEventListener('afterprint', function() {
            // Restore QR code styling
            const canvas = document.getElementById('qr-code');
            canvas.style.border = '2px solid #e5e7eb';
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey || e.metaKey) {
                switch(e.key) {
                    case 'p':
                        e.preventDefault();
                        window.print();
                        break;
                    case 's':
                        e.preventDefault();
                        downloadPDF();
                        break;
                }
            }
        });
    </script>
</body>
</html>
