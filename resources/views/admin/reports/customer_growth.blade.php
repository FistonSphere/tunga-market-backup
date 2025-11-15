@extends('admin.layouts.header')

@section('content')

<style>
    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 14px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        height: 100%;
    }
    .stat-label { color: #6c757d; font-size: .9rem; }
    .stat-value { font-size: 1.4rem; font-weight: 700; }
</style>

<div class="page-header mb-4">
    <h2 class="fw-bold">👥 Customer Growth & User Activity</h2>
    <p class="text-muted">Monitor how your users join and interact with the platform.</p>
</div>

<form method="GET" class="d-flex gap-2 mb-3">
    <label class="fw-bold">Range:</label>
    <select name="range" class="form-select w-auto" onchange="this.form.submit()">
        <option value="7"  {{ $range==7 ? 'selected' : '' }}>Last 7 Days</option>
        <option value="14" {{ $range==14 ? 'selected' : '' }}>Last 14 Days</option>
        <option value="30" {{ $range==30 ? 'selected' : '' }}>Last 30 Days</option>
        <option value="90" {{ $range==90 ? 'selected' : '' }}>Last 90 Days</option>
    </select>
</form>

<!-- AI INSIGHTS -->
<div class="alert alert-info p-3 rounded-3 shadow-sm mb-4">
    <h5 class="fw-bold">🤖 AI Insights</h5>
    <p><strong>Trend: </strong>
        <span class="{{ $insights['trend'] === 'up' ? 'text-success' : 'text-danger' }}">
            {{ $insights['growth_rate'] }}%
        </span>
    </p>
    <p class="mb-0">{{ $insights['note'] }}</p>
</div>

<!-- SUMMARY -->
<div class="row g-3 mb-4">
    <div class="col-md-3 col-6">
        <div class="stat-card">
            <div class="stat-label">Total Customers</div>
            <div class="stat-value">{{ number_format($summary['total_customers']) }}</div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card">
            <div class="stat-label">New Customers</div>
            <div class="stat-value">{{ number_format($summary['new_customers']) }}</div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card">
            <div class="stat-label">Active Users</div>
            <div class="stat-value">{{ number_format($summary['active_users']) }}</div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card">
            <div class="stat-label">Retention Rate</div>
            <div class="stat-value">{{ $summary['retention_rate'] }}%</div>
        </div>
    </div>
</div>

<!-- CHARTS -->
<div class="card p-3 mb-4 shadow-sm rounded-4">
    <h5 class="fw-bold">📈 New Customer Growth</h5>
    <div id="customerGrowthChart" style="height: 350px;"></div>
</div>

<div class="card p-3 shadow-sm rounded-4">
    <h5 class="fw-bold">🔥 User Activity Trend</h5>
    <div id="userActivityChart" style="height: 350px;"></div>
</div>

<!-- TOP ACTIVE USERS -->
<div class="card p-3 shadow-sm rounded-4 mt-4">
    <h5 class="fw-bold">🏆 Top Active Users</h5>
    <table class="table table-striped">
        <thead><tr><th>User</th><th>Activity Count</th></tr></thead>
        <tbody>
            @foreach ($topActiveUsers as $u)
                <tr>
                    <td>{{ $u->user?->first_name }} {{ $u->user?->last_name }}</td>
                    <td>{{ $u->activity_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- MOST VISITED PAGES -->
<div class="card p-3 shadow-sm rounded-4 mt-4">
    <h5 class="fw-bold">📄 Most Visited Pages</h5>
    <ul class="list-group">
        @foreach ($visitedPages as $p)
            <li class="list-group-item d-flex justify-content-between">
                <span>{{ $p->page_visited }}</span>
                <strong>{{ $p->visits }}</strong>
            </li>
        @endforeach
    </ul>
</div>

<!-- DEVICE / BROWSER STATS -->
<div class="row mt-4 g-3">
    <div class="col-md-6">
        <div class="card p-3 shadow-sm rounded-4">
            <h5 class="fw-bold">📱 Device Usage</h5>
            <div id="deviceChart" style="height: 300px;"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-3 shadow-sm rounded-4">
            <h5 class="fw-bold">🌐 Browser Usage</h5>
            <div id="browserChart" style="height: 300px;"></div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/echarts@5"></script>

<script>
    const customerGrowth = @json($customerGrowth);
    const activity = @json($activeUsers);
    const deviceStats = @json($deviceStats);
    const browserStats = @json($browserStats);

    const dates1 = customerGrowth.map(x => x.date);
    const newUsers = customerGrowth.map(x => x.count);

    const dates2 = activity.map(x => x.date);
    const active = activity.map(x => x.count);

    // CUSTOMER GROWTH CHART
    echarts.init(document.getElementById('customerGrowthChart')).setOption({
        tooltip: { trigger: 'axis' },
        xAxis: { type: 'category', data: dates1 },
        yAxis: { type: 'value' },
        series: [{
            name: 'New Customers',
            type: 'line',
            data: newUsers,
            smooth: true,
            lineStyle: { width: 3 }
        }]
    });

    // USER ACTIVITY CHART
    echarts.init(document.getElementById('userActivityChart')).setOption({
        tooltip: { trigger: 'axis' },
        xAxis: { type: 'category', data: dates2 },
        yAxis: { type: 'value' },
        series: [{
            name: 'Active Users',
            type: 'line',
            data: active,
            smooth: true,
            lineStyle: { width: 3 }
        }]
    });

    // DEVICE USAGE PIE
    echarts.init(document.getElementById('deviceChart')).setOption({
        tooltip: { trigger: 'item' },
        series: [{
            type: 'pie',
            data: deviceStats.map(x => ({ name: x.device, value: x.count }))
        }]
    });

    // BROWSER USAGE PIE
    echarts.init(document.getElementById('browserChart')).setOption({
        tooltip: { trigger: 'item' },
        series: [{
            type: 'pie',
            data: browserStats.map(x => ({ name: x.browser, value: x.count }))
        }]
    });
</script>

@endsection
