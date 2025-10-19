@extends('admin.layouts.header')

@section('content')
    <style>
        /* Card improvements */
        .flash-deal-card {
            transition: all 0.2s ease-in-out;
        }

        .flash-deal-card:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
            transform: translateY(-3px);
        }

        /* FlipDown customizations */
        .flipdown {
            margin-top: 10px;
            text-align: center;
            width: 300px;
        }

        .flipdown .rotor-group {
            margin: 0 5px;
        }

        .flipdown .rotor,
        .flipdown .rotor-top,
        .flipdown .rotor-leaf-front,
        .flipdown .rotor-leaf-rear {
            background: #343a40;
            /* Dark UI for contrast */
            color: #fff;
            font-size: 1.25rem;
        }

        .flipdown.flipdown__theme-dark .rotor,
        .flipdown.flipdown__theme-dark .rotor-top,
        .flipdown.flipdown__theme-dark .rotor-leaf-front {
            background-color: #FF5722;
        }

        .flipdown.flipdown__theme-dark .rotor-bottom,
        .flipdown.flipdown__theme-dark .rotor-leaf-rear {
            background-color: #001428;
        }

        .flipdown .rotor-group-heading {
            color: #6c757d;
            font-size: 0.75rem;
        }

        .flash-deal-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .flash-deal-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .avatar-group .avatar-wrapper {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #fff;
            margin-left: -10px;
            position: relative;
            z-index: 1;
            background-color: #f1f1f1;
            transition: transform 0.2s ease-in-out;
        }

        .avatar-group .avatar-wrapper:first-child {
            margin-left: 0;
        }

        .avatar-group .avatar-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-group .more-count {
            background-color: #e0e0e0;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .avatar-group .avatar-wrapper:hover {
            transform: scale(1.05);
            z-index: 2;
        }
    </style>
    <div class="row">
        <!-- Total Users -->
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget">
                <div class="dash-widgetimg">
                    <span><img src="{{ asset('admin/assets/img/icons/users1.svg') }}" alt="Users"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{ $totalUsers }}">{{ $totalUsers }}</span></h5>
                    <h6>Total Users</h6>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash1">
                <div class="dash-widgetimg">
                    <span><img src="{{ asset('admin/assets/img/icons/product.svg') }}" alt="Products"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{ $totalProducts }}">{{ $totalProducts }}</span></h5>
                    <h6>Total Products</h6>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash2">
                <div class="dash-widgetimg">
                    <span><img src="{{ asset('admin/assets/img/icons/shopping-cart.svg') }}" alt="Orders"
                            style="width:14px;height:21px"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{ $totalOrders }}">{{ $totalOrders }}</span></h5>
                    <h6>Total Orders</h6>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash3">
                <div class="dash-widgetimg">
                    <span><img src="{{ asset('admin/assets/img/icons/dollar-square.svg') }}" alt="Revenue"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5>Rwf<span class="counters">{{ $abbreviatedRevenue }}</span></h5>
                    <h6>Total Revenue</h6>
                </div>
            </div>
        </div>

        <!-- Pending Carts -->
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count">
                <div class="dash-counts">
                    <h4>{{ $pendingCarts }}</h4>
                    <h5>Pending Carts</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="shopping-bag"></i>
                </div>
            </div>
        </div>

        <!-- Contact Requests -->
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das1">
                <div class="dash-counts">
                    <h4>{{ $contactRequests }}</h4>
                    <h5>Contact Requests</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="mail"></i>
                </div>
            </div>
        </div>

        <!-- Activity Logs -->
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das2">
                <div class="dash-counts">
                    <h4>{{ $activityLogs }}</h4>
                    <h5>Activity Logs</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="activity"></i>
                </div>
            </div>
        </div>

        <!-- Product Views Today -->
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das3">
                <div class="dash-counts">
                    <h4>{{ $productViewsToday }}</h4>
                    <h5>Views Today</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="eye"></i>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-7 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Sales Overview (Last 7 Days)</h5>
                </div>
                <div class="card-body">
                    <div id="sales-overview-chart" style="min-height: 350px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Recently Added Products</h4>
                    <div class="dropdown">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                            <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a href="productlist.html" class="dropdown-item">Product List</a>
                            </li>
                            <li>
                                <a href="addproduct.html" class="dropdown-item">Product Add</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive dataview">
                        <table class="table datatable ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Products</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentProducts as $recentProduct)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="productimgname">
                                            <a href="productlist.html" class="product-img">
                                                <img src="{{ $recentProduct->main_image }}" style="border-radius: 8px"
                                                    alt="{{ $recentProduct->name }}">
                                            </a>
                                            <a href="productlist.html">{{ $recentProduct->name }}</a>
                                        </td>
                                        <td>{{ $recentProduct->category->name }}</td>
                                        <td>Rwf{{ number_format($recentProduct->price) }}</td>
                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Recent 5 Orders</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentOrders as $recentOrder)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="productimgname">
                                            {{ $recentOrder->user->last_name }} {{ $recentOrder->user->first_name }}
                                        </td>
                                        <td>{{ number_format($recentOrder->total) }} Rwf</td>
                                        <td>
                                            @php
                                                $status = $recentOrder->status;
                                                $badgeClass = match ($status) {
                                                    'Delivered' => 'badge bg-success',
                                                    'Processing' => 'badge bg-warning text-dark',
                                                    'Cancelled' => 'badge bg-danger',
                                                    default => 'badge bg-secondary',
                                                };
                                            @endphp
                                            <span class="{{ $badgeClass }}">{{ $status }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No recent orders found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Recent Customers</h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Signup Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentUsers as $recentUser)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $recentUser->last_name }} {{ $recentUser->first_name }}
                                        </td>
                                        <td>{{ $recentUser->email }}</td>
                                        <td>{{ $recentUser->created_at->format('d M y') }}</td>
                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Top 3 Flash Deals</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        @forelse ($activeFlashDeals as $deal)
                            <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                                <div class="card shadow-sm border-0 h-100 flash-deal-card">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <span class="badge bg-danger text-uppercase">Flash Deal</span>
                                                <small class="text-muted">
                                                    Ends {{ $deal->end_time->format('M d, H:i') }}
                                                </small>
                                            </div>

                                            <h5 class="card-title fw-semibold mb-1">
                                                {{ Str::limit($deal->product->name, 40) }}
                                            </h5>

                                            <p class="mb-2 text-muted small">
                                                @if($deal->discount_percent)
                                                    <span class="text-success fw-semibold">{{ $deal->discount_percent }}%
                                                        OFF</span><br>
                                                @endif
                                                <span class="text-dark fw-bold">Now:
                                                    Rwf{{ number_format($deal->flash_price) }}</span>
                                            </p>

                                            @if($deal->stock_limit)
                                                <div class="progress mb-2" style="height: 6px;">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 60%">
                                                    </div>
                                                </div>
                                                <p class="small text-muted mb-2">
                                                    Stock remaining: {{ $deal->stock_limit }}
                                                </p>
                                            @endif
                                        </div>

                                        {{-- Countdown --}}
                                        <div class="mt-auto">
                                            <div id="countdown-{{ $deal->id }}" class="flipdown"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info text-center mb-0">
                                    No active flash deals at the moment.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title">🌍 User Distribution by Country</h5>
                </div>
                <div class="card-body">
                    <div id="geo_chart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow mb-4">
                <div class="card-header bg-warning text-dark d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">
                        🛒 Abandoned Carts
                    </h5>
                    <span class="badge bg-dark-subtle text-dark fw-normal">
                        {{ $abandonedCarts->count() }} users
                    </span>
                </div>
                <div class="card-body">
                    @forelse($abandonedCarts as $userId => $items)
                        @php
                            $user = $items->first()->user;
                            $total = $items->sum(fn($item) => $item->product->price * $item->quantity);
                            $lastUpdated = $items->first()->updated_at->diffForHumans();
                        @endphp

                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start flex-wrap">
                                    <div class="mb-3 mb-md-0">
                                        <h6 class="mb-1">
                                            <i class="bi bi-person-circle text-primary me-1"></i>
                                            {{ $user->last_name }} {{ $user->first_name }}
                                            <span class="badge bg-secondary ms-1">{{ count($items) }} items</span>
                                        </h6>
                                        <p class="mb-1 text-muted small">
                                            <i class="bi bi-clock-history me-1"></i> Last activity: {{ $lastUpdated }}
                                        </p>
                                        <p class="mb-0 text-danger fw-semibold">
                                            <i class="bi bi-exclamation-circle me-1"></i>
                                            Potential Loss: Rwf{{ number_format($total) }}
                                        </p>
                                    </div>

                                    {{-- Overlapping product images --}}
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-group d-flex me-3">
                                            @foreach ($items->take(5) as $item)
                                                <div class="avatar-wrapper" data-bs-toggle="tooltip"
                                                    title="{{ $item->product->name }}">
                                                    <img src="{{ asset($item->product->main_image) }}"
                                                        alt="{{ $item->product->name }}" class="avatar-img">
                                                </div>
                                            @endforeach

                                            @if ($items->count() > 5)
                                                <div class="avatar-wrapper more-count">
                                                    +{{ $items->count() - 5 }}
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Toggle button --}}
                                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse"
                                            data-bs-target="#userCart-{{ $userId }}">
                                            View Cart <i class="bi bi-chevron-down ms-1"></i>
                                        </button>
                                    </div>
                                </div>

                                {{-- Cart Items --}}
                                <div class="collapse mt-3" id="userCart-{{ $userId }}">
                                    <ul class="list-group list-group-flush small">
                                        @foreach ($items as $item)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    <strong>{{ $item->product->name }}</strong> × {{ $item->quantity }}
                                                </div>
                                                <span class="text-muted">
                                                    Rwf{{ number_format($item->product->price * $item->quantity) }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-light text-center mb-0">
                            <i class="bi bi-info-circle me-1"></i> No abandoned carts found.
                        </div>
                    @endforelse
                </div>

            </div>

        </div>
    </div>



    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const options = {
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: { show: false },
                    zoom: { enabled: false },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                series: [{
                    name: 'Revenue (Rwf)',
                    data: {!! json_encode($salesTotals) !!}
                }],
                xaxis: {
                    categories: {!! json_encode($salesDates) !!},
                    labels: {
                        style: {
                            colors: '#6c757d',
                            fontSize: '13px',
                        }
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function (value) {
                            if (value >= 1000000) return (value / 1000000).toFixed(1) + 'M';
                            if (value >= 1000) return (value / 1000).toFixed(1) + 'K';
                            return value;
                        },
                        style: {
                            colors: '#6c757d',
                            fontSize: '13px',
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function (value) {
                            return 'Rwf ' + new Intl.NumberFormat().format(value);
                        }
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: 'vertical',
                        shadeIntensity: 0.5,
                        gradientToColors: ['#28a745'],
                        inverseColors: true,
                        opacityFrom: 0.6,
                        opacityTo: 0.1,
                        stops: [0, 90, 100]
                    }
                },
                colors: ['#28a745']
            };

            const chart = new ApexCharts(document.querySelector("#sales-overview-chart"), options);
            chart.render();
        });


        document.addEventListener("DOMContentLoaded", function () {
            @foreach ($activeFlashDeals as $deal)
                new FlipDown(
                    Math.floor(new Date("{{ $deal->end_time->toIso8601String() }}").getTime() / 1000),
                    'countdown-{{ $deal->id }}'
                ).start();
            @endforeach
                 });

        google.charts.load('current', {
            'packages': ['geochart'],
            // Optional: restrict to regions
            'mapsApiKey': '' // Optional if you want advanced features
        });

        google.charts.setOnLoadCallback(drawRegionsMap);

        function drawRegionsMap() {
            const data = google.visualization.arrayToDataTable([
                ['Country', 'Users'],
                @foreach ($userLocations as $location)
                    ['{{ $location->country }}', {{ $location->total }}],
                @endforeach
                            ]);

            const options = {
                colorAxis: { colors: ['#c6e48b', '#239a3b'] }, // green scale
                backgroundColor: '#ffffff',
                datalessRegionColor: '#f5f5f5',
                defaultColor: '#f5f5f5',
                legend: { textStyle: { color: '#666' } }
            };

            const chart = new google.visualization.GeoChart(document.getElementById('geo_chart'));
            chart.draw(data, options);
        }
    </script>

@endsection