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

    <!-- Filters -->
    <form method="GET" class="d-flex gap-2 mb-3" id="filtersForm">
        <label class="fw-bold">Range:</label>
        <select name="range" class="form-select w-auto" onchange="document.getElementById('filtersForm').submit();">
            <option value="7" {{ $range == 7 ? 'selected' : '' }}>Last 7 Days</option>
            <option value="14" {{ $range == 14 ? 'selected' : '' }}>Last 14 Days</option>
            <option value="30" {{ $range == 30 ? 'selected' : '' }}>Last 30 Days</option>
            <option value="90" {{ $range == 90 ? 'selected' : '' }}>Last 90 Days</option>
        </select>

        <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control w-auto"
            placeholder="Search name or email">
        <select name="role" class="form-select w-auto">
            <option value="">All roles</option>
            <option value="customer" {{ ($role ?? '') == 'customer' ? 'selected' : '' }}>Customer</option>
            <option value="vendor" {{ ($role ?? '') == 'vendor' ? 'selected' : '' }}>Vendor</option>
        </select>

        <button class="btn btn-primary">Apply</button>
    </form>

    <!-- AI INSIGHTS -->
    <div class="alert alert-info p-3 rounded-3 shadow-sm mb-4" id="insightsBox">
        <h5 class="fw-bold">🤖 AI Insights</h5>
        <p><strong>Trend: </strong>
            <span id="insightTrend" class="{{ $insights['trend'] === 'up' ? 'text-success' : 'text-danger' }}">
                {{ $insights['growth_rate'] ?? 0 }}%
            </span>
        </p>
        <p id="insightNote">{{ $insights['note'] ?? '' }}</p>
    </div>

    <!-- SUMMARY -->
    <div class="row g-3 mb-4" id="summaryCards">
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-label">Total Customers</div>
                <div class="stat-value" id="totalCustomers">{{ number_format($summary['total_customers'] ?? 0) }}</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-label">New Customers</div>
                <div class="stat-value" id="newCustomers">{{ number_format($summary['new_customers'] ?? 0) }}</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-label">Active Users</div>
                <div class="stat-value" id="activeUsers">{{ number_format($summary['active_users'] ?? 0) }}</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-label">Retention Rate</div>
                <div class="stat-value" id="retentionRate">{{ $summary['retention_rate'] ?? 0 }}%</div>
            </div>
        </div>
    </div>

    <!-- Line charts -->
    <div class="card p-3 mb-4 shadow-sm rounded-4 chart-card">
        <h5 class="fw-bold">📈 New Customer Growth</h5>
        <div id="customerGrowthChart" style="height: 350px;"></div>
    </div>

    <div class="card p-3 mb-4 shadow-sm rounded-4 chart-card">
        <h5 class="fw-bold">🔥 User Activity Trend</h5>
        <div id="userActivityChart" style="height: 350px;"></div>
    </div>

    <!-- Map + Heatmap + Cohort -->
    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card p-3 shadow-sm rounded-4 chart-card">
                <h5 class="fw-bold">🌍 Users by Country</h5>
                <div id="worldMap" style="height: 420px;"></div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card p-3 shadow-sm rounded-4 chart-card">
                <h5 class="fw-bold">⏱️ Activity Heatmap (Weekday × Hour)</h5>
                <div id="hourHeatmap" style="height: 420px;"></div>
            </div>
        </div>
    </div>

    <div class="card mt-4 p-3 shadow-sm rounded-4 chart-card">
        <h5 class="fw-bold">🔢 Retention Cohort Heatmap (weekly cohorts)</h5>
        <div id="cohortHeatmap" style="height: 420px;"></div>
    </div>

    <!-- Top users/pages -->
    <div class="row mt-4 g-3">
        <div class="col-lg-6">
            <div class="card p-3 shadow-sm rounded-4">
                <h5 class="fw-bold">🏆 Top Active Users</h5>
                <table class="table table-striped mb-0" id="topUsersTable">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Activity Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topActiveUsers ?? [] as $u)
                            <tr>
                                <td>{{ $u->user?->first_name }} {{ $u->user?->last_name }}</td>
                                <td>{{ $u->activity_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card p-3 shadow-sm rounded-4">
                <h5 class="fw-bold">📄 Most Visited Pages</h5>
                <ul class="list-group" id="visitedPagesList">
                    @foreach ($visitedPages ?? [] as $p)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $p->page_visited }}</span>
                            <strong>{{ $p->visits }}</strong>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Device / Browser -->
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

    <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts@5/theme/dark.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts@5/map/js/world.js"></script>


    <script>
        (function () {
            // ---------- Config ----------
            const DATA_URL = "{{ route('admin.reports.customerGrowth.data') }}"; // AJAX endpoint
            const REFRESH_INTERVAL_MS = 20000; // 20 seconds
            const THEME = 'dark'; // Option A

            // ---------- Initial server-side data (for immediate render) ----------
            const initial = {
                summary: @json($summary ?? []),
                customerGrowth: @json($customerGrowth ?? []),
                activeUsers: @json($activeUsers ?? []),
                deviceStats: @json($deviceStats ?? []),
                browserStats: @json($browserStats ?? []),
                locationData: @json($locationData ?? []),
                heatmapData: @json($heatmapData ?? []),
                cohortMatrix: @json($cohortMatrix ?? []),
                cohortWeeks: @json($cohortWeeks ?? []),
                topActiveUsers: @json($topActiveUsers ?? []),
                visitedPages: @json($visitedPages ?? []),
                insights: @json($insights ?? []),
            };

            // ---------- Create charts (dark theme) ----------
            const customerChart = echarts.init(document.getElementById('customerGrowthChart'), THEME);
            const activityChart = echarts.init(document.getElementById('userActivityChart'), THEME);
            const deviceChart = echarts.init(document.getElementById('deviceChart'), THEME);
            const browserChart = echarts.init(document.getElementById('browserChart'), THEME);
            const worldChart = echarts.init(document.getElementById('worldMap'), THEME);
            const hourChart = echarts.init(document.getElementById('hourHeatmap'), THEME);
            const cohortChart = echarts.init(document.getElementById('cohortHeatmap'), THEME);

            // ---------- Utility: safe arrays ----------
            function safeArray(arr) { return Array.isArray(arr) ? arr : []; }

            // ---------- Render functions ----------
            function renderSummary(summary) {
                document.getElementById('totalCustomers').textContent = Number(summary.total_customers || 0).toLocaleString();
                document.getElementById('newCustomers').textContent = Number(summary.new_customers || 0).toLocaleString();
                document.getElementById('activeUsers').textContent = Number(summary.active_users || 0).toLocaleString();
                document.getElementById('retentionRate').textContent = (summary.retention_rate ?? 0) + '%';
                // insights
                document.getElementById('insightTrend').textContent = (summary.growth_rate ?? (initial.insights.growth_rate ?? 0)) + '%';
                document.getElementById('insightNote').textContent = (summary.note ?? (initial.insights.note ?? ''));
            }

            function renderCustomerGrowth(data) {
                const dates = safeArray(data).map(r => r.date);
                const values = safeArray(data).map(r => r.count);

                const opt = {
                    tooltip: { trigger: 'axis' },
                    xAxis: { type: 'category', data: dates, axisLabel: { rotate: 30 } },
                    yAxis: { type: 'value' },
                    series: [{ name: 'New Customers', type: 'line', data: values, smooth: true, lineStyle: { width: 3 } }]
                };
                customerChart.setOption(opt, true);
            }

            function renderActivity(data) {
                const dates = safeArray(data).map(r => r.date);
                const values = safeArray(data).map(r => r.count);

                const opt = {
                    tooltip: { trigger: 'axis' },
                    xAxis: { type: 'category', data: dates, axisLabel: { rotate: 30 } },
                    yAxis: { type: 'value' },
                    series: [{ name: 'Active Users', type: 'line', data: values, smooth: true, lineStyle: { width: 3 } }]
                };
                activityChart.setOption(opt, true);
            }

            function renderDeviceBrowser(deviceStats, browserStats) {
                // Device
                const devData = safeArray(deviceStats).map(r => ({ name: r.device || r.name || 'Unknown', value: r.count || r.value || 0 }));
                deviceChart.setOption({
                    tooltip: { trigger: 'item' },
                    series: [{ type: 'pie', radius: '60%', data: devData }]
                }, true);

                // Browser
                const brData = safeArray(browserStats).map(r => ({ name: r.browser || r.name || 'Unknown', value: r.count || r.value || 0 }));
                browserChart.setOption({
                    tooltip: { trigger: 'item' },
                    series: [{ type: 'pie', radius: '60%', data: brData }]
                }, true);
            }

            function renderWorldMap(locationData) {
                const data = safeArray(locationData).map(i => ({
                    name: i.name || 'Unknown',
                    value: i.value || 0
                }));

                if (!data.length) {
                    // fill a dummy to prevent crash
                    data.push({ name: 'United States', value: 0 });
                }

                const maxVal = Math.max(...data.map(d => d.value), 1);

                worldChart.setOption({
                    tooltip: { trigger: 'item', formatter: '{b}: {c}' },
                    visualMap: { min: 0, max: maxVal, text: ['High', 'Low'], calculable: true, inRange: { color: ['#dbeafe', '#60a5fa', '#1e40af'] } },
                    series: [{ name: 'Users by Country', type: 'map', map: 'world', roam: true, emphasis: { label: { show: true } }, data }]
                }, true);
            }


            function renderHourHeatmap(heatmapData) {
                const data = safeArray(heatmapData).map(d => d.slice());
                if (data.length === 0) { data.push([0, 0, 0]); }

                const weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                const hours = Array.from({ length: 24 }, (_, i) => (i < 10 ? '0' + i : String(i)) + ':00');

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
                    visualMap: { min: 0, max: Math.max(...data.map(d => d[2]), 1), calculable: true, orient: 'horizontal', left: 'center', bottom: '0%' },
                    series: [{ name: 'Activity', type: 'heatmap', data, emphasis: { itemStyle: { borderColor: '#333', borderWidth: 1 } }, progressive: 1000 }]
                }, true);
            }

            function renderCohort(cohortMatrix) {
                const matrix = safeArray(cohortMatrix);
                if (!matrix.length) {
                    cohortChart.setOption({ title: { text: 'No cohort data available' } }, true);
                    return;
                }

                // build data
                const yAxis = matrix.map(r => r.cohort_week);
                const xAxis = matrix[0].retention.map((_, i) => 'Week+' + i);
                let cohortData = [];
                let maxRetention = 0;
                matrix.forEach((row, i) => {
                    row.retention.forEach((val, j) => {
                        cohortData.push([i, j, val]);
                        if (val > maxRetention) maxRetention = val;
                    });
                });

                cohortChart.setOption({
                    tooltip: {
                        formatter: function (params) {
                            const cohortLabel = matrix[params.value[0]]?.cohort_week ?? '';
                            return `${cohortLabel}<br/>Week +${params.value[1]}: ${params.value[2]}% retention`;
                        }
                    },
                    xAxis: { type: 'category', data: xAxis },
                    yAxis: { type: 'category', data: yAxis },
                    visualMap: { min: 0, max: maxRetention || 100, calculable: true, orient: 'horizontal', left: 'center', bottom: '5%' },
                    series: [{ name: 'Cohort', type: 'heatmap', data: cohortData, emphasis: { itemStyle: { borderColor: '#333', borderWidth: 1 } }, progressive: 500 }]
                }, true);
            }

            function renderTopUsers(topUsers) {
                const tbody = document.querySelector('#topUsersTable tbody');
                if (!tbody) return;
                tbody.innerHTML = '';
                safeArray(topUsers).forEach(u => {
                    const tr = document.createElement('tr');
                    const name = (u.user?.first_name ?? '') + ' ' + (u.user?.last_name ?? '');
                    tr.innerHTML = `<td>${name}</td><td>${u.activity_count ?? u.activity_count ?? 0}</td>`;
                    tbody.appendChild(tr);
                });
            }

            function renderVisitedPages(pages) {
                const ul = document.getElementById('visitedPagesList');
                if (!ul) return;
                ul.innerHTML = '';
                safeArray(pages).forEach(p => {
                    const li = document.createElement('li');
                    li.className = 'list-group-item d-flex justify-content-between';
                    li.innerHTML = `<span>${p.page_visited}</span><strong>${p.visits}</strong>`;
                    ul.appendChild(li);
                });
            }

            // ---------- Initial render from server-side variables ----------
            renderSummary(initial.summary || {});
            renderCustomerGrowth(initial.customerGrowth || []);
            renderActivity(initial.activeUsers || []);
            renderDeviceBrowser(initial.deviceStats || [], initial.browserStats || []);
            renderWorldMap(initial.locationData || []);
            renderHourHeatmap(initial.heatmapData || []);
            renderCohort(initial.cohortMatrix || []);
            renderTopUsers(initial.topActiveUsers || []);
            renderVisitedPages(initial.visitedPages || []);

            // ---------- Auto-refresh / AJAX fetching ----------
            async function fetchAndUpdate() {
                try {
                    // attach current querystring so server-side filters are preserved
                    const qs = new URLSearchParams(window.location.search).toString();
                    const url = DATA_URL + (qs ? '?' + qs : '');
                    const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                    if (!res.ok) throw new Error('Network response was not OK');

                    const data = await res.json();

                    // Render provided pieces (each check is defensive)
                    if (data.summary) renderSummary(data.summary);
                    if (data.customerGrowth) renderCustomerGrowth(data.customerGrowth);
                    if (data.activeUsers) renderActivity(data.activeUsers);
                    if (data.deviceStats || data.browserStats) renderDeviceBrowser(data.deviceStats || [], data.browserStats || []);
                    if (data.locationData) renderWorldMap(data.locationData);
                    if (data.heatmapData) renderHourHeatmap(data.heatmapData);
                    if (data.cohortMatrix) renderCohort(data.cohortMatrix);
                    if (data.topActiveUsers) renderTopUsers(data.topActiveUsers);
                    if (data.visitedPages) renderVisitedPages(data.visitedPages);
                    if (data.insights) {
                        document.getElementById('insightNote').textContent = data.insights.note || '';
                        document.getElementById('insightTrend').textContent = (data.insights.growth_rate ?? '') + '%';
                    }
                } catch (err) {
                    // Don't spam console — log concise message and retry next interval
                    // (if you want verbose logs, remove the check)
                    if (console && console.error) console.error('Analytics refresh failed:', err.message || err);
                }
            }

            // Start auto-refresh loop (first update after interval)
            let refreshTimer = setInterval(fetchAndUpdate, REFRESH_INTERVAL_MS);

            // Also support manual refresh via custom event (optional)
            window.addEventListener('analytics:refresh', fetchAndUpdate);

            // Resize charts when window changes
            window.addEventListener('resize', () => {
                [customerChart, activityChart, deviceChart, browserChart, worldChart, hourChart, cohortChart].forEach(c => { try { c.resize(); } catch (e) { } });
            });

        })();
    </script>
@endsection
