@extends('admin.layouts.header')

@section('content')

    <style>
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 14px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .stat-label {
            color: #6c757d;
            font-size: .9rem;
        }

        .stat-value {
            font-size: 1.4rem;
            font-weight: 700;
        }
    </style>

    <div class="page-header mb-4">
        <h2 class="fw-bold">👥 Customer Growth & User Activity</h2>
        <p class="text-muted">Monitor how your users join and interact with the platform.</p>
    </div>

    <form method="GET" class="d-flex gap-2 mb-3">
        <label class="fw-bold">Range:</label>
        <select name="range" class="form-select w-auto" onchange="this.form.submit()">
            <option value="7" {{ $range == 7 ? 'selected' : '' }}>Last 7 Days</option>
            <option value="14" {{ $range == 14 ? 'selected' : '' }}>Last 14 Days</option>
            <option value="30" {{ $range == 30 ? 'selected' : '' }}>Last 30 Days</option>
            <option value="90" {{ $range == 90 ? 'selected' : '' }}>Last 90 Days</option>
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

    <!-- Add Filters / Search at top (if not present) -->
    <form method="GET" class="row g-2 mb-3">
        <div class="col-auto">
            <select name="range" class="form-select" onchange="this.form.submit()">
                <option value="7" {{ $range == 7 ? 'selected' : '' }}>7d</option>
                <option value="14" {{ $range == 14 ? 'selected' : '' }}>14d</option>
                <option value="30" {{ $range == 30 ? 'selected' : '' }}>30d</option>
                <option value="90" {{ $range == 90 ? 'selected' : '' }}>90d</option>
            </select>
        </div>
        <div class="col-auto">
            <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control"
                placeholder="Search name or email">
        </div>
        <div class="col-auto">
            <select name="role" class="form-select" onchange="this.form.submit()">
                <option value="">All roles</option>
                <option value="customer" {{ ($role ?? '') == 'customer' ? 'selected' : '' }}>Customer</option>
                <option value="vendor" {{ ($role ?? '') == 'vendor' ? 'selected' : '' }}>Vendor</option>
            </select>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary">Apply</button>
        </div>
    </form>
    <!-- New blocks: World map, Hours heatmap, Cohort heatmap -->
    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card p-3 shadow-sm rounded-4">
                <h5 class="fw-bold">🌍 Users by Country</h5>
                <div id="worldMap" style="height: 420px;"></div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card p-3 shadow-sm rounded-4">
                <h5 class="fw-bold">⏱️ Activity Heatmap (Weekday × Hour)</h5>
                <div id="hourHeatmap" style="height: 420px;"></div>
            </div>
        </div>
    </div>

    <div class="card mt-4 p-3 shadow-sm rounded-4">
        <h5 class="fw-bold">🔢 Retention Cohort Heatmap (weekly cohorts)</h5>
        <div id="cohortHeatmap" style="height: 420px;"></div>
    </div>

    <!-- TOP ACTIVE USERS -->
    <div class="card p-3 shadow-sm rounded-4 mt-4">
        <h5 class="fw-bold">🏆 Top Active Users</h5>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Activity Count</th>
                </tr>
            </thead>
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
    <!-- ECharts + world map dependency -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
    <!-- Optional: world map data (ECharts needs map data). Using CDN for world map -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5/map/js/world.js"></script>

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

        // LOCATION DATA for world map
        const locationData = @json($locationData); // [{name:'Rwanda', value:10}, ...]
        const maxVal = Math.max(...locationData.map(x => x.value), 1);

        const worldChart = echarts.init(document.getElementById('worldMap'));
        worldChart.setOption({
            tooltip: {
                trigger: 'item',
                formatter: '{b}: {c}'
            },
            visualMap: {
                min: 0,
                max: maxVal,
                text: ['High', 'Low'],
                realtime: false,
                calculable: true,
                inRange: { color: ['#dbeafe', '#60a5fa', '#1e40af'] }
            },
            series: [{
                name: 'Users by Country',
                type: 'map',
                map: 'world',
                roam: true,
                emphasis: { label: { show: true } },
                data: locationData
            }]
        });

        // HOUR HEATMAP
        // heatmapData: array of [weekdayIndex (0=Sun), hour (0..23), value]
        const heatmapData = @json($heatmapData);

        // prepare axis labels: weekday names and hours
        const weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        const hours = Array.from({ length: 24 }, (_, i) => (i < 10 ? '0' + i : String(i)) + ':00');

        const hourChart = echarts.init(document.getElementById('hourHeatmap'));
        hourChart.setOption({
            tooltip: {
                position: 'top',
                formatter: function (params) {
                    return `${weekdays[params.value[0]]} ${hours[params.value[1]]}<br/>${params.value[2]} hits`;
                }
            },
            grid: { height: '70%', top: '10%' },
            xAxis: { type: 'category', data: hours, splitArea: { show: true } },
            yAxis: { type: 'category', data: weekdays, splitArea: { show: true } },
            visualMap: {
                min: 0,
                max: (heatmapData.length ? Math.max(...heatmapData.map(d => d[2])) : 1),
                calculable: true,
                orient: 'horizontal',
                left: 'center',
                bottom: '0%'
            },
            series: [{
                name: 'Activity',
                type: 'heatmap',
                data: heatmapData,
                emphasis: { itemStyle: { borderColor: '#333', borderWidth: 1 } },
                progressive: 1000,
                progressiveThreshold: 5000
            }]
        });

        // COHORT HEATMAP
        // cohortMatrix = [{cohort_week: '2025-11-03', size: 20, retention: [100, 60, 45, ...]}, ...]
        const cohortMatrix = @json($cohortMatrix);
        const cohortWeeks = @json($cohortWeeks); // array of week keys (strings)
        // build series data as [cohortIndex, weekOffset, value]
        let cohortData = [];
        let maxRetention = 0;
        cohortMatrix.forEach((row, i) => {
            row.retention.forEach((val, j) => {
                cohortData.push([i, j, val]);
                if (val > maxRetention) maxRetention = val;
            });
        });

        const cohortChart = echarts.init(document.getElementById('cohortHeatmap'));
        cohortChart.setOption({
            tooltip: {
                formatter: function (params) {
                    const cohortLabel = cohortMatrix[params.value[0]]?.cohort_week ?? '';
                    const weekOffset = params.value[1];
                    const val = params.value[2];
                    return `${cohortLabel}<br/>Week +${weekOffset}: ${val}% retention`;
                }
            },
            xAxis: { type: 'category', data: cohortMatrix.length ? cohortMatrix[0].retention.map((_, i) => 'Week+' + i) : [] },
            yAxis: { type: 'category', data: cohortMatrix.map(r => r.cohort_week) },
            visualMap: {
                min: 0,
                max: maxRetention || 100,
                calculable: true,
                orient: 'horizontal',
                left: 'center',
                bottom: '5%'
            },
            series: [{
                name: 'Cohort',
                type: 'heatmap',
                data: cohortData,
                emphasis: { itemStyle: { borderColor: '#333', borderWidth: 1 } },
                progressive: 500,
            }]
        });

        // ensure charts resize on window resize
        window.addEventListener('resize', () => {
            worldChart.resize();
            hourChart.resize();
            cohortChart.resize();
        });
    </script>

@endsection
