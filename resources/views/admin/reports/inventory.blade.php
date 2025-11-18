@extends('admin.layouts.header')

@section('content')
    <style>
        .stat-card {
            background: white;
            padding: 16px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.04);
            height: 100%;
        }

        .stat-label {
            color: #6c757d;
            font-size: .9rem
        }

        .stat-value {
            font-size: 1.3rem;
            font-weight: 700
        }

        .small-muted {
            color: #6c757d;
            font-size: .85rem
        }

        .table-fixed {
            max-height: 420px;
            overflow: auto;
            display: block;
        }
    </style>

    <div class="page-header mb-3">
        <h3 class="fw-bold">Inventory & Stock Movement Report</h3>
        <p class="text-muted">Overview of current stock, top sellers, and movement history.</p>
    </div>

    {{-- Filters --}}
    <form id="filtersForm" class="row g-2 mb-3">
        <div class="col-auto d-flex align-items-center">
            <label class="fw-bold me-2">Range:</label>
            <select name="range" id="filterRange" class="form-select">
                <option value="7" {{ $range == 7 ? 'selected' : '' }}>7 days</option>
                <option value="14" {{ $range == 14 ? 'selected' : '' }}>14 days</option>
                <option value="30" {{ $range == 30 ? 'selected' : '' }}>30 days</option>
                <option value="90" {{ $range == 90 ? 'selected' : '' }}>90 days</option>
            </select>
        </div>

        <div class="col-auto">
            <input type="text" name="search" id="filterSearch" class="form-control" placeholder="Search product or SKU">
        </div>

        <div class="col-auto">
            <select name="category_id" id="filterCategory" class="form-select">
                <option value="">All categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-auto">
            <button type="button" id="applyFilters" class="btn btn-primary">Apply</button>
        </div>

        <div class="col-auto ms-auto text-end">
            <a id="exportCsvBtn" class="btn btn-outline-secondary">Export CSV</a>
        </div>
    </form>

    {{-- Summary KPIs --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-6">
            <div class="stat-card text-center">
                <div class="stat-label">Total Products</div>
                <div class="stat-value" id="kpiTotalProducts">{{ number_format($totalProducts ?? 0) }}</div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="stat-card text-center">
                <div class="stat-label">Inventory Value</div>
                <div class="stat-value" id="kpiInventoryValue">{{ number_format($totalInventoryValue ?? 0) }}</div>
                <div class="small-muted">in site currency</div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="stat-card text-center">
                <div class="stat-label">Low Stock (&le;10)</div>
                <div class="stat-value" id="kpiLowStock">{{ number_format($lowStockCount ?? 0) }}</div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="stat-card text-center">
                <div class="stat-label">Out of Stock</div>
                <div class="stat-value" id="kpiOutStock">{{ number_format($outOfStockCount ?? 0) }}</div>
            </div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="row g-3 mb-4">
        <div class="col-lg-6">
            <div class="card p-3 shadow-sm rounded-3">
                <h5 class="fw-bold">📊 Stock Levels</h5>
                <div id="stockLevelsChart" style="height:360px"></div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card p-3 shadow-sm rounded-3">
                <h5 class="fw-bold">🔥 Top Sellers (by units sold)</h5>
                <div id="topSellersChart" style="height:360px"></div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-lg-12">
            <div class="card p-3 shadow-sm rounded-3">
                <h5 class="fw-bold">📈 Movement Trend (daily sold)</h5>
                <div id="movementTrendChart" style="height:280px"></div>
            </div>
        </div>
    </div>

    {{-- Recent movements + table --}}
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card p-3 shadow-sm rounded-3">
                <h5 class="fw-bold">🧾 Recent Stock Movements</h5>
                <div class="table-responsive table-fixed mt-2">
                    <table class="table table-striped mb-0" id="movementsTable">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Product</th>
                                <th>Type</th>
                                <th>Qty</th>
                                <th>Order</th>
                                <th>Customer</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- filled by JS --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card p-3 shadow-sm rounded-3 mb-3">
                <h6 class="fw-bold">📉 Low Stock</h6>
                <ul id="lowStockList" class="list-group list-group-flush mt-2"></ul>
            </div>

            <div class="card p-3 shadow-sm rounded-3">
                <h6 class="fw-bold">🚫 Out of Stock</h6>
                <ul id="outStockList" class="list-group list-group-flush mt-2"></ul>
            </div>
        </div>
    </div>

    {{-- ECharts CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>

    <script>
        (function () {
            const DATA_URL = "{{ route('admin.reports.inventory.data') }}";
            const EXPORT_URL = "{{ route('admin.reports.inventory.export') }}";
            const REFRESH_MS = 20000; // 20s
            // initial filters
            const qs = new URLSearchParams(window.location.search);
            const initialRange = qs.get('range') || '{{ $range }}';

            // Chart instances
            const stockChart = echarts.init(document.getElementById('stockLevelsChart'));
            const topChart = echarts.init(document.getElementById('topSellersChart'));
            const trendChart = echarts.init(document.getElementById('movementTrendChart'));

            // DOM helpers
            const $apply = document.getElementById('applyFilters');
            const $range = document.getElementById('filterRange');
            const $search = document.getElementById('filterSearch');
            const $category = document.getElementById('filterCategory');
            const $export = document.getElementById('exportCsvBtn');

            function buildQuery() {
                const p = new URLSearchParams();
                if ($range.value) p.set('range', $range.value);
                if ($search.value) p.set('search', $search.value);
                if ($category.value) p.set('category_id', $category.value);
                return p.toString() ? ('?' + p.toString()) : '';
            }

            async function fetchDataAndRender() {
                try {
                    const q = buildQuery();
                    const res = await fetch(DATA_URL + q, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                    if (!res.ok) throw new Error('Network response not OK');
                    const json = await res.json();

                    // KPIs
                    document.getElementById('kpiTotalProducts').textContent = (json.totalProducts || 0).toLocaleString();
                    document.getElementById('kpiInventoryValue').textContent = Number(json.totalInventoryValue || 0).toLocaleString();
                    document.getElementById('kpiLowStock').textContent = (json.low_stock_items?.length || 0).toLocaleString();
                    document.getElementById('kpiOutStock').textContent = (json.out_of_stock_items?.length || 0).toLocaleString();

                    // stock chart
                    const products = (json.products || []).slice(0, 40); // limit labels
                    const names = products.map(p => p.name);
                    const stocks = products.map(p => p.stock_quantity);
                    const stockValues = products.map(p => p.stock_value);

                    stockChart.setOption({
                        tooltip: {
                            trigger: 'axis', formatter: (params) => {
                                const p = params[0];
                                return `${p.axisValue}<br/>Stock: ${p.data}`;
                            }
                        },
                        grid: { left: '10%', right: '4%', bottom: '10%' },
                        xAxis: { type: 'category', data: names, axisLabel: { rotate: 40 } },
                        yAxis: { type: 'value' },
                        series: [{ name: 'Stock', type: 'bar', data: stocks }]
                    }, true);

                    // top sellers
                    const top = (json.top_sellers || []);
                    const topNames = top.map(t => {
                        const prod = (json.products || []).find(p => p.id == t.product_id);
                        return prod ? prod.name : ('#' + (t.product_id || ''));
                    });
                    const topValues = top.map(t => t.total_sold || 0);

                    topChart.setOption({
                        tooltip: { trigger: 'axis' },
                        grid: { left: '8%', right: '6%', bottom: '10%' },
                        xAxis: { type: 'category', data: topNames, axisLabel: { rotate: 40 } },
                        yAxis: { type: 'value' },
                        series: [{ name: 'Units sold', type: 'bar', data: topValues }]
                    }, true);

                    // daily movement trend
                    const daily = (json.daily_sold || json.daily_sold === undefined ? json.daily_sold : json.daily_sold) || json.daily_sold || [];
                    const trendDates = (daily || []).map(d => d.date);
                    const trendValues = (daily || []).map(d => d.sold || d.total || 0);

                    trendChart.setOption({
                        tooltip: { trigger: 'axis' },
                        xAxis: { type: 'category', data: trendDates },
                        yAxis: { type: 'value' },
                        series: [{ name: 'Daily sold', type: 'line', data: trendValues, smooth: true }]
                    }, true);

                    // movements table
                    const tbody = document.querySelector('#movementsTable tbody');
                    tbody.innerHTML = '';
                    (json.movements || []).forEach(m => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `<td>${m.date ? (new Date(m.date)).toLocaleString() : ''}</td>
                                    <td>${escapeHtml(m.product_name || m.product?.name || '')}</td>
                                    <td>${escapeHtml(m.type || 'Sale')}</td>
                                    <td>${m.qty ?? m.quantity ?? ''}</td>
                                    <td>${m.order_no ?? m.order_no ?? ''}</td>
                                    <td>${escapeHtml(m.customer ?? m.customer_name ?? 'Guest')}</td>`;
                        tbody.appendChild(tr);
                    });

                    // low / out lists
                    const lowList = document.getElementById('lowStockList');
                    lowList.innerHTML = '';
                    (json.low_stock_items || []).slice(0, 10).forEach(i => {
                        const li = document.createElement('li');
                        li.className = 'list-group-item';
                        li.textContent = `${i.name} — ${i.stock_quantity}`;
                        lowList.appendChild(li);
                    });

                    const outList = document.getElementById('outStockList');
                    outList.innerHTML = '';
                    (json.out_of_stock_items || []).slice(0, 10).forEach(i => {
                        const li = document.createElement('li');
                        li.className = 'list-group-item';
                        li.textContent = `${i.name}`;
                        outList.appendChild(li);
                    });

                } catch (err) {
                    console.error('Inventory fetch failed:', err);
                }
            }

            // small escape helper
            function escapeHtml(s) {
                if (!s && s !== 0) return '';
                return String(s).replace(/[&<>"']/g, function (m) { return ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[m]); });
            }

            // attach apply button
            $apply.addEventListener('click', () => {
                fetchDataAndRender();
            });

            // attach export
            $export.addEventListener('click', () => {
                const q = buildQuery();
                window.location = EXPORT_URL + q;
            });

            // initial load and interval
            fetchDataAndRender();
            setInterval(fetchDataAndRender, REFRESH_MS);

            // handle resize for charts
            window.addEventListener('resize', () => {
                [stockChart, topChart, trendChart].forEach(c => { try { c.resize(); } catch (e) { } });
            });

        })();
    </script>
@endsection
