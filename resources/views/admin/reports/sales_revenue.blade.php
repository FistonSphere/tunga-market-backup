@extends('admin.layouts.header')

@section('content')

    <style>
        .stat-card {
            background: white;
            padding: 18px;
            border-radius: 14px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            text-align: center;
            height: 100%;
        }

        .stat-card .label {
            font-size: .9rem;
            color: #6c757d;
        }

        .stat-card .value {
            font-size: 1.3rem;
            font-weight: 700;
            color: #000;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .stat-card .value {
                font-size: 1.1rem;
            }
        }
    </style>
    <div class="page-header mb-4">
        <h2 class="fw-bold">📊 Sales Revenue Report</h2>
        <p class="text-muted">Track and analyze revenue performance over time.</p>
    </div>

    <!-- FILTERS -->
    <form method="GET" class="d-flex align-items-center gap-2 mb-3">
        <label class="fw-bold">Range:</label>
        <select name="range" class="form-select w-auto" onchange="this.form.submit()">
            <option value="7" {{ $range == 7 ? 'selected' : '' }}>Last 7 Days</option>
            <option value="14" {{ $range == 14 ? 'selected' : '' }}>Last 14 Days</option>
            <option value="30" {{ $range == 30 ? 'selected' : '' }}>Last 30 Days</option>
            <option value="90" {{ $range == 90 ? 'selected' : '' }}>Last 90 Days</option>
        </select>
    </form>

    <div class="alert alert-info p-3 rounded-3 shadow-sm mb-4">
        <h5 class="fw-bold">🤖 AI Insights Summary</h5>
        <p class="mb-1">
            <strong>Growth Rate:</strong>
            <span class="{{ $insights['trend'] === 'up' ? 'text-success' : 'text-danger' }}">
                {{ $insights['growth_rate'] }}%
            </span>
        </p>
        <p class="mb-0">{{ $insights['note'] }}</p>
    </div>


    <!-- SUMMARY CARDS -->
    <div class="row mb-4 g-3">
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="label">Total Revenue</div>
                <div class="value">{{ number_format($summary['total_revenue'], 0) }} RWF</div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="label">Average per Day</div>
                <div class="value">{{ number_format($summary['average_per_day'], 0) }} RWF</div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="label">Highest Day</div>
                <div class="value">{{ number_format($summary['highest_day'], 0) }} RWF</div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="label">Lowest Day</div>
                <div class="value">{{ number_format($summary['lowest_day'], 0) }} RWF</div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm p-3 rounded-4 mt-4">
        <h5 class="fw-bold mb-3">👑 Top Buying Customers</h5>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Total Spent (RWF)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topCustomers as $c)
                    <tr>
                        <td>{{ $c->customer_name }}</td>
                        <td>{{ number_format($c->spent) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- CHART -->
    <div class="card shadow-sm p-3 rounded-4">
        <h5 class="fw-bold mb-3">📈 Revenue Trend (Last {{ $range }} Days)</h5>
        <div id="revenueChart" style="height: 350px;"></div>
    </div>

    <div class="card shadow-sm p-3 rounded-4 mt-4">
        <h5 class="fw-bold mb-3">📉 Comparison: This Period vs Previous Period</h5>
        <div id="comparisonChart" style="height: 350px;"></div>
    </div>





    <!-- ECharts -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>

    <script>
        const prevData = @json($previousPeriod);

        const prevDates = prevData.map(r => r.date);
        const prevAmounts = prevData.map(r => r.total_revenue);

        const comparisonChart = echarts.init(document.getElementById('comparisonChart'));

        comparisonChart.setOption({
            tooltip: { trigger: 'axis' },
            legend: { data: ['Current Period', 'Previous Period'] },
            xAxis: { type: 'category', data: dates },
            yAxis: { type: 'value' },
            series: [
                {
                    name: 'Current Period',
                    type: 'line',
                    data: amounts,
                    smooth: true,
                    lineStyle: { width: 3 }
                },
                {
                    name: 'Previous Period',
                    type: 'line',
                    data: prevAmounts,
                    smooth: true,
                    lineStyle: { type: 'dashed', width: 2 }
                }
            ]
        });

        const chartData = @json($revenueData);

        const dates = chartData.map(row => row.date);
        const amounts = chartData.map(row => row.total_revenue);

        const chart = echarts.init(document.getElementById('revenueChart'));

        const option = {
            tooltip: {
                trigger: 'axis',
            },
            xAxis: {
                type: 'category',
                data: dates,
                boundaryGap: false,
            },
            yAxis: {
                type: 'value',
            },
            series: [{
                name: 'Revenue',
                type: 'line',
                smooth: true,
                showSymbol: true,
                symbolSize: 8,
                lineStyle: {
                    width: 3,
                    color: '#007bff'
                },
                areaStyle: {
                    opacity: 0.4,
                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                        { offset: 0, color: '#007bff' },
                        { offset: 1, color: '#cfe2ff' }
                    ])
                },
                data: amounts
            }]
        };

        chart.setOption(option);
        window.addEventListener('resize', chart.resize);
    </script>
@endsection
