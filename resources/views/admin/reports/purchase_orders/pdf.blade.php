<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Purchase Orders Report</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        h2 {
            color: #2563eb;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px;
        }

        th {
            background: #f5f5f5;
            text-align: left;
        }

        .stat-box {
            display: inline-block;
            width: 23%;
            background: #f8f9fa;
            margin: 1%;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }

        .stat-value {
            font-weight: bold;
            font-size: 18px;
            color: #2563eb;
        }

        .chart-container {
            margin-top: 20px;
            height: 250px;
        }
    </style>
</head>

<body>

    <h2>Purchase Orders Report</h2>
    <p>From: {{ $startDate->format('d M Y') }} To: {{ $endDate->format('d M Y') }}</p>

    <div class="stats">
        <div class="stat-box">
            <div class="stat-value">{{ $summary['total_orders'] }}</div>
            <div>Total Orders</div>
        </div>
        <div class="stat-box">
            <div class="stat-value">{{ number_format($summary['total_revenue'], 0) }} RWF</div>
            <div>Total Revenue</div>
        </div>
        <div class="stat-box">
            <div class="stat-value">{{ number_format($summary['total_tax'], 0) }}</div>
            <div>Total Tax</div>
        </div>
        <div class="stat-box">
            <div class="stat-value">{{ $summary['delivered_orders'] }}</div>
            <div>Delivered Orders</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#Invoice</th>
                <th>Customer</th>
                <th>Items</th>
                <th>Total</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->invoice_number }}</td>
                    <td>{{ $order->user->name ?? 'Guest' }}</td>
                    <td>{{ $order->items->count() }}</td>
                    <td>{{ number_format($order->total, 0) }} RWF</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->payment_method }}</td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="chart-container">
        <canvas id="ordersChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            chart: { type: 'line', height: 250, toolbar: { show: false } },
            series: [{
                name: 'Orders',
                data: @json($orders->map(fn($o) => ['x' => $o->created_at->format('Y-m-d'), 'y' => $o->total]))
            }],
            xaxis: { type: 'category' },
            stroke: { curve: 'smooth', width: 3 },
            markers: { size: 4 },
            tooltip: { x: { format: 'dd MMM yyyy' }, y: { formatter: val => val + ' RWF' } },
            colors: ['#2563eb']
        };
        var chart = new ApexCharts(document.querySelector("#ordersChart"), options);
        chart.render();
    </script>

</body>

</html>