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

       <div class="container-fluid py-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Analytics Dashboard</h2>

            <!-- SEARCH + FILTER -->
            <form id="filterForm" class="d-flex gap-2">
                <input type="text" name="search" class="form-control"
                       placeholder="Search users, emails, countries...">

                <select name="date_range" class="form-select">
                    <option value="7">Last 7 days</option>
                    <option value="30">Last 30 days</option>
                    <option value="90">Last 90 days</option>
                    <option value="365">Last 12 months</option>
                </select>

                <button class="btn btn-primary">Apply</button>
            </form>
        </div>

        <!-- SUMMARY CARDS -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm p-3">
                    <h6>Total Users</h6>
                    <h3 id="totalUsers">0</h3>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm p-3">
                    <h6>New Users (30 days)</h6>
                    <h3 id="newUsers">0</h3>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm p-3">
                    <h6>Active Today</h6>
                    <h3 id="activeToday">0</h3>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm p-3">
                    <h6>Registrations Trend</h6>
                    <h3 id="regTrend">0%</h3>
                </div>
            </div>
        </div>

        <!-- CHARTS -->
        <div class="row g-4">

            <!-- USER GROWTH -->
            <div class="col-lg-6">
                <div class="card shadow-sm p-3">
                    <h5 class="mb-3 fw-bold">User Growth</h5>
                    <div id="userGrowthChart" style="height: 330px;"></div>
                </div>
            </div>

            <!-- WORLD MAP -->
            <div class="col-lg-6">
                <div class="card shadow-sm p-3">
                    <h5 class="mb-3 fw-bold">Users by Country</h5>
                    <div id="worldMap" style="height: 330px;"></div>
                </div>
            </div>

            <!-- HOURLY HEATMAP -->
            <div class="col-lg-6">
                <div class="card shadow-sm p-3">
                    <h5 class="mb-3 fw-bold">Active Hours Heatmap</h5>
                    <div id="heatmap" style="height: 330px;"></div>
                </div>
            </div>

            <!-- RETENTION COHORT -->
            <div class="col-lg-6">
                <div class="card shadow-sm p-3">
                    <h5 class="mb-3 fw-bold">User Retention Cohort</h5>
                    <div id="retentionCohort" style="height: 330px;"></div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts@5/map/js/world.js"></script>

    <script>
    /* ===============================
       DARK MODE ECHARTS THEME
    ================================ */
    const darkTheme = {
        backgroundColor: "transparent",
        textStyle: { color: "#e0e0e0" },
        title: { textStyle: { color: "#fff" } },
        tooltip: { backgroundColor: "#333", textStyle: { color: "#fff" } },
        visualMap: {
            textStyle: { color: "#fff" }
        }
    };

    echarts.registerTheme("dark", darkTheme);

    /* ===============================
       INIT CHARTS
    ================================ */
    let userGrowthChart = echarts.init(document.getElementById('userGrowthChart'), 'dark');
    let worldMapChart   = echarts.init(document.getElementById('worldMap'), 'dark');
    let heatmapChart    = echarts.init(document.getElementById('heatmap'), 'dark');
    let retentionChart  = echarts.init(document.getElementById('retentionCohort'), 'dark');

    /* ===============================
       AUTO REFRESH FUNCTION
    ================================ */
    function loadDashboardData() {
        const params = new URLSearchParams(new FormData(document.getElementById('filterForm')));

        fetch(`{{ route('admin.dashboard.data') }}?` + params, {
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(res => res.json())
        .then(data => {

            // SUMMARY NUMBERS
            document.getElementById('totalUsers').textContent = data.totalUsers;
            document.getElementById('newUsers').textContent = data.newUsers;
            document.getElementById('activeToday').textContent = data.activeToday;
            document.getElementById('regTrend').textContent = data.regTrend + "%";

            /* ==========================
               USER GROWTH CHART
            ========================== */
            userGrowthChart.setOption({
                xAxis: { type: 'category', data: data.userGrowth.labels },
                yAxis: { type: 'value' },
                tooltip: { trigger: 'axis' },
                series: [{
                    name: 'Users',
                    type: 'line',
                    smooth: true,
                    data: data.userGrowth.values
                }]
            });

            /* ==========================
               WORLD MAP — DYNAMIC COUNTRY LIST
            ========================== */
            worldMapChart.setOption({
                tooltip: { trigger: 'item' },
                visualMap: {
                    min: 1,
                    max: data.maxCountryValue,
                    calculable: true
                },
                series: [{
                    type: 'map',
                    map: 'world',
                    roam: true,
                    data: data.countryDistribution   // <- dynamic from DB
                }]
            });

            /* ==========================
               HEATMAP — ACTIVE HOURS
            ========================== */
            heatmapChart.setOption({
                tooltip: {},
                xAxis: { type: 'category', data: data.heatmap.hours },
                yAxis: { type: 'category', data: data.heatmap.days },
                visualMap: { min: 0, max: data.heatmap.max, calculable: true },
                series: [{
                    name: 'Activity',
                    type: 'heatmap',
                    data: data.heatmap.data
                }]
            });

            /* ==========================
               RETENTION COHORT
            ========================== */
            retentionChart.setOption({
                tooltip: {},
                xAxis: { type: 'category', data: data.cohort.labels },
                yAxis: { type: 'category', data: data.cohort.weeks },
                visualMap: { min: 0, max: 100, calculable: true },
                series: [{
                    name: 'Retention %',
                    type: 'heatmap',
                    data: data.cohort.data
                }]
            });
        });
    }

    /* AUTO REFRESH */
    loadDashboardData();
    setInterval(loadDashboardData, 10000);

    /* REFRESH ON FILTER SUBMIT */
    document.getElementById('filterForm').addEventListener('submit', function(e) {
        e.preventDefault();
        loadDashboardData();
    });
    </script>
@endsection

