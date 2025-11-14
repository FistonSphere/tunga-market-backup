<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Purchase Orders Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts + Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN for modern styling -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Chart.js for interactive charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; color: #001428; }
        .brand-orange { color: #fe5e0e; }
        .brand-bg { background-color: #001428; color: #fff; }
        .stat-box { padding: 1.5rem; border-radius: 0.75rem; background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.05); text-align: center; }
        .stat-value { font-size: 1.75rem; font-weight: 700; }
        .stat-label { font-size: 0.875rem; color: #6c757d; }
        .badge-status { padding: 0.25rem 0.5rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 600; color: #fff; }
        .badge-pending { background-color: #ffc107; }
        .badge-processing { background-color: #17a2b8; }
        .badge-delivered { background-color: #28a745; }
        .badge-cancelled { background-color: #dc3545; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Purchase Orders Report</h1>
        <button onclick="window.print()" class="no-print px-4 py-2 rounded bg-orange-500 text-white hover:bg-orange-600">Print / Save as PDF</button>
    </div>

    <!-- Filters Summary -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="stat-box">
            <div class="stat-value">{{ $summary['total_orders'] }}</div>
            <div class="stat-label">Total Orders</div>
        </div>
        <div class="stat-box">
            <div class="stat-value">{{ number_format($summary['total_revenue'], 0) }} RWF</div>
            <div class="stat-label">Total Revenue</div>
        </div>
        <div class="stat-box">
            <div class="stat-value">{{ number_format($summary['total_tax'], 0) }}</div>
            <div class="stat-label">Total Tax Collected</div>
        </div>
        <div class="stat-box">
            <div class="stat-value">{{ $summary['delivered_orders'] }}</div>
            <div class="stat-label">Delivered Orders</div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="overflow-x-auto mb-6">
        <table class="min-w-full bg-white rounded-lg shadow-sm">
            <thead class="brand-bg">
                <tr>
                    <th class="px-4 py-2 text-left">Invoice</th>
                    <th class="px-4 py-2 text-left">Customer</th>
                    <th class="px-4 py-2 text-left">Total</th>
                    <th class="px-4 py-2 text-left">Payment</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $order->invoice_number }}</td>
                        <td class="px-4 py-2">{{ $order->user->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ number_format($order->total, 0) }} RWF</td>
                        <td class="px-4 py-2">{{ ucfirst($order->payment_method) }}</td>
                        <td class="px-4 py-2">
                            @php
                                $badge = match ($order->status) {
                                    'Pending' => 'badge-pending',
                                    'Processing' => 'badge-processing',
                                    'Delivered' => 'badge-delivered',
                                    'Cancelled' => 'badge-cancelled',
                                    default => 'badge-pending'
                                };
                            @endphp
                            <span class="badge-status {{ $badge }}">{{ $order->status }}</span>
                        </td>
                        <td class="px-4 py-2">{{ $order->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Chart Visualization -->
    <div class="mb-6 p-4 bg-white rounded-lg shadow-sm">
        <h2 class="text-lg font-bold mb-4">Order Volume (Last 30 Days)</h2>
        <canvas id="ordersChart" height="120"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('ordersChart').getContext('2d');
        const chartData = @json($orders->groupBy(fn($o) => $o->created_at->format('Y-m-d'))->map(fn($group, $date) => ['date' => $date, 'count' => $group->count()]));

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.map(d => d.date),
                datasets: [{
                    label: 'Orders',
                    data: chartData.map(d => d.count),
                    backgroundColor: '#fe5e0e',
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: { beginAtZero: true, grid: { color: '#e5e7eb' }, ticks: { stepSize: 1 } }
                }
            }
        });
    </script>

</body>
</html>
