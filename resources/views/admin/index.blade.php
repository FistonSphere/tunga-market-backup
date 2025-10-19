@extends('admin.layouts.header')

@section('content')
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
        @foreach ($activeFlashDeals as $deal)
            <div class="col-md-4">
                <div class="card border-left-danger shadow">
                    <div class="card-header bg-danger text-white">
                        <h6 class="mb-0">🔥 Flash Deal</h6>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $deal->product->name }}</h5>
                        <p>
                            <strong>Now:</strong> Rwf{{ number_format($deal->flash_price) }}<br>
                            @if($deal->discount_percent)
                                <strong>Discount:</strong> {{ $deal->discount_percent }}% Off<br>
                            @endif
                            @if($deal->stock_limit)
                                <strong>Stock Left:</strong> {{ $deal->stock_limit }}<br>
                            @endif
                        </p>
                        <div id="countdown-{{ $deal->id }}" class="flipdown my-2"></div>
                        <p class="text-muted small mb-0">
                            Ends at: {{ $deal->end_time->format('M d, Y H:i') }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>




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
        </script>

@endsection