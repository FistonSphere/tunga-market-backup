@extends('admin.layouts.header')


@section('content')
    <style>
        .user-header .user-avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-actions .btn {
            border-radius: 10px;
            font-weight: 500;
        }

        .stats-card {
            transition: 0.3s;
            border-left: 5px solid #001428;
        }

        .stats-card:hover {
            transform: translateY(-4px);
            background-color: #f8f9fa;
        }



        .product-thumb {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
        }

        @media (max-width: 768px) {
            .user-header {
                flex-direction: column;
                text-align: center;
            }

            .user-actions {
                margin-top: 15px;
            }
        }

        #userBehaviorChart {
            max-height: 280px;
            margin-top: 10px;
        }

        .card h5 svg {
            margin-right: 6px;
            vertical-align: middle;
        }

        .card small.text-muted {
            font-size: 0.85rem;
        }

        /* User stats container */
        .user-stats {
            --transition: all 0.3s ease-in-out;
        }

        /* Each card */
        .stats-card {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            border-radius: 16px;
            padding: 20px;
            color: #fff;
            background: #f8f9fa;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        /* Icon on the left */
        .stats-icon {
            width: 58px;
            height: 58px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.2);
            margin-right: 16px;
            flex-shrink: 0;
        }

        /* Info text */
        .stats-info h6 {
            font-size: 0.9rem;
            font-weight: 500;
            opacity: 0.85;
            margin-bottom: 4px;
            letter-spacing: 0.3px;
        }

        .stats-info h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }

        /* Hover effect */
        .stats-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        /* Gradient styles for each type */
        .gradient-blue {
            background: linear-gradient(135deg, #001528, #023768);
        }

        .gradient-orange {
            background: linear-gradient(135deg, #ff5e0e, #fc8447);
        }

        .gradient-green {
            background: linear-gradient(135deg, #05ca33, #30d649);
        }

        .gradient-purple {
            background: linear-gradient(135deg, #6f42c1, #b97aff);
        }

        /* Responsive tweaks */
        @media (max-width: 767px) {
            .stats-card {
                flex-direction: row;
                text-align: left;
                padding: 16px;
            }

            .stats-icon {
                width: 50px;
                height: 50px;
            }

            .stats-info h3 {
                font-size: 1.5rem;
            }
        }

        /* Tabs container */
        .custom-tabs {
            border: none;
            display: flex;
            justify-content: flex-start;
            gap: 10px;
            overflow-x: auto;
            padding-bottom: 6px;
            scrollbar-width: none;
        }

        .custom-tabs::-webkit-scrollbar {
            display: none;
        }

        /* Each tab button */
        .custom-tabs .nav-link {
            border: none;
            background: #f7f7f8;
            color: #555;
            font-weight: 600;
            border-radius: 30px;
            padding: 10px 22px;
            transition: all 0.3s ease;
            position: relative;
            font-size: 0.95rem;
            letter-spacing: 0.2px;
            box-shadow: inset 0 0 0 1px rgba(0, 0, 0, 0.05);
        }

        /* Hover effect */
        .custom-tabs .nav-link:hover {
            color: #000;
            background: linear-gradient(135deg, #f3f3f3, #ffffff);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        /* Active tab with gradient underline */
        .custom-tabs .nav-link.active {
            color: #fff;
            background: linear-gradient(135deg, #ff5f0e, #ff7733);
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.25);
            transform: translateY(-1px);
        }

        /* Smooth underline animation */


        /* Animation keyframes */
        @keyframes tabUnderline {
            from {
                width: 0;
                opacity: 0;
            }

            to {
                width: 40%;
                opacity: 1;
            }
        }

        /* Responsive tweaks */
        @media (max-width: 767px) {
            .custom-tabs .nav-link {
                font-size: 0.9rem;
                padding: 8px 16px;
            }
        }

        /* --- Tab Content Base --- */
        .tab-content {
            background: #f9fafb;
            border-radius: 14px;
            padding: 0.5rem;
            transition: all 0.3s ease;
        }

        .tab-pane {
            animation: fadeIn 0.4s ease-in-out;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* --- Card Styling --- */
        .card {
            background: #fff;
            border: 1px solid #eaeaea;
            border-radius: 16px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.04);
            transition: all 0.25s ease-in-out;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        }

        .card h5 {
            font-size: 1.1rem;
            color: #001428;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card p {
            font-size: 0.95rem;
            color: #4a4a4a;
            line-height: 1.5;
        }

        /* --- Contact Info Section --- */
        #overview p strong {
            color: #001428;
            min-width: 120px;
            display: inline-block;
        }

        /* --- Orders Table --- */
        .table {
            border-collapse: separate;
            border-spacing: 0 8px;
            width: 100%;
        }

        .table thead th {
            background: #f5f7fa;
            border: none;
            color: #5c5c5c;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            padding: 10px 16px;
        }

        .table tbody tr {
            background: #fff;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: #f3faff;
            transform: scale(1.01);
        }

        .table td {
            border: none;
            padding: 12px 16px;
            color: #333;
            font-size: 0.93rem;
        }

        .table .badge {
            border-radius: 20px;
            font-weight: 500;
            padding: 6px 12px;
            text-transform: capitalize;
        }

        /* --- Wishlist --- */
        .list-group-item {
            border: none;
            border-bottom: 1px solid #f0f0f0;
            padding: 12px 0;
            font-size: 0.95rem;
            color: #333;
            transition: all 0.2s ease;
        }

        .list-group-item:hover {
            background: #f7faff;
        }

        .product-thumb {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #eee;
            transition: transform 0.2s ease;
        }

        .product-thumb:hover {
            transform: scale(1.05);
        }

        /* --- Behavior Analytics Section --- */
        #activity h5 {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        #activity small.text-muted {
            font-size: 0.85rem;
        }

        #activity canvas {
            margin-bottom: 20px;
            border-radius: 10px;
            background: #f8f9fc;
            padding: 10px;
            box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.05);
        }

        /* --- Responsive --- */
        @media (max-width: 992px) {
            .table thead {
                display: none;
            }

            .table tbody tr {
                display: block;
                margin-bottom: 1rem;
                border-radius: 10px;
                background: #fff;
                padding: 0.8rem;
            }

            .table tbody td {
                display: flex;
                justify-content: space-between;
                padding: 8px 0;
                font-size: 0.9rem;
                border: none;
            }

            .table tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #666;
            }
        }

        .user-chart-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 6px 18px rgba(0, 20, 40, 0.08);
            padding: 24px 28px;
            height: 360px;
            position: relative;
        }

        .user-chart-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            height: 4px;
            width: 100%;
            background: linear-gradient(90deg, #ff5f0e, #001428);
            border-top-left-radius: 14px;
            border-top-right-radius: 14px;
        }

        .apexcharts-tooltip {
            background: #001428 !important;
            color: #fff !important;
            border: none !important;
            border-radius: 8px !important;
            box-shadow: 0 2px 10px rgba(0, 20, 40, 0.25) !important;
        }

        .apexcharts-xaxis text,
        .apexcharts-yaxis text {
            font-weight: 500;
            color: #001428 !important;
        }
    .apexcharts-bar-area:hover {
        filter: drop-shadow(0 0 8px rgba(255, 95, 14, 0.5));
        transition: all 0.3s ease;
    }
        </style>


        <div class="user-details-page container-fluid py-4">

            <!-- Header -->
            <div class="user-header card shadow-sm rounded-4 mb-4">
                <div class="card-body d-flex flex-wrap align-items-center">
                    <img src="{{ asset($user->profile_picture ?? 'assets/images/default-user.png') }}" class="user-avatar me-4"
                        alt="{{ $user->first_name }}">

                    <div class="flex-grow-1">
                        <h3 class="fw-bold mb-1">{{ $user->first_name }} {{ $user->last_name }}</h3>
                        <p class="text-muted mb-1">{{ $user->email }}</p>
                        <p class="small text-secondary">
                            <i class="bi bi-geo-alt"></i>
                            {{ $user->city }}, {{ $user->country }}
                        </p>
                    </div>

                    <div class="user-actions">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline-primary me-2">
                            Edit Profile
                        </a>
                        <button class="btn btn-outline-danger"
                            onclick="confirmDeleteUser({{ $user->id }}, '{{ $user->first_name }}')">
                            Delete
                        </button>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="row mb-4 g-3 user-stats">
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card gradient-blue">
                        <div class="stats-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white" viewBox="0 0 16 16">
                                <path
                                    d="M8 0a8 8 0 1 0 8 8A8.009 8.009 0 0 0 8 0ZM4.285 12.433a6.978 6.978 0 0 1 0-8.866l.825.825a5.979 5.979 0 0 0 0 7.216Zm7.43 0-.825-.825a5.979 5.979 0 0 0 0-7.216l.825-.825a6.978 6.978 0 0 1 0 8.866ZM8 10a2 2 0 1 1 2-2 2.002 2.002 0 0 1-2 2Z" />
                            </svg>
                        </div>
                        <div class="stats-info">
                            <h6>Total Orders</h6>
                            <h3>{{ $user->orders->count() }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="stats-card gradient-orange">
                        <div class="stats-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white" viewBox="0 0 16 16">
                                <path
                                    d="M3.5 2a.5.5 0 0 1 .5.5V3h8v-.5a.5.5 0 0 1 1 0V3a2 2 0 0 1 2 2v8.5a.5.5 0 0 1-1 0V13H2v.5a.5.5 0 0 1-1 0V5a2 2 0 0 1 2-2v-.5a.5.5 0 0 1 .5-.5Z" />
                            </svg>
                        </div>
                        <div class="stats-info">
                            <h6>Wishlist Items</h6>
                            <h3>{{ $user->wishlistItems->count() }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="stats-card gradient-green">
                        <div class="stats-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white" viewBox="0 0 16 16">
                                <path
                                    d="M8 0a8 8 0 1 0 8 8A8.009 8.009 0 0 0 8 0ZM4.285 12.433a6.978 6.978 0 0 1
                                                    0-8.866l.825.825a5.979 5.979 0 0 0 0 7.216Zm7.43 0-.825-.825a5.979 5.979 0 0 0
                                                    0-7.216l.825-.825a6.978 6.978 0 0 1 0 8.866ZM8 10a2 2 0 1 1 2-2 2.002 2.002 0 0 1-2 2Z" />
                            </svg>
                        </div>
                        <div class="stats-info">
                            <h6>Platform Rating</h6>
                            <h3>⭐ {{ number_format($user->platform_rating, 1) }}/5</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class=" stats-card gradient-purple">
                        <div class="stats-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height=" 28" fill="white" viewBox="0 0 16 16">
                                <path d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v12l-5-2.5L3 14V2z" />
                            </svg>
                        </div>
                        <div class=" stats-info">
                            <h6>Activity Logs</h6>
                            <h3>{{ $user->activityLogs->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Tabs -->
            <ul class="nav nav-tabs custom-tabs mb-3" id="userTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#overview" role="tab">
                        Overview
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#orders" role="tab"> Orders </button>
                </li>
                <li class="nav-item">
                    <button class=" nav-link" data-bs-toggle="tab" data-bs-target="#wishlist" role="tab">
                        Wishlist
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#activity" role="tab">
                        Activity Logs
                    </button>
                </li>
            </ul>


            <div class="tab-content">
                <!-- Overview -->
                <div class="tab-pane fade show active" id="overview">
                    <div class="card p-4 rounded-4 shadow-sm">
                        <h5 class="fw-bold mb-3">Contact Information</h5>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Phone:</strong> {{ $user->phone ?? '—' }}</p>
                        <p><strong>Address:</strong> {{ $user->address_line ?? '—' }}, {{ $user->city }}, {{ $user->state }},
                            {{ $user->country }}
                        </p>
                        <p><strong>Two-Factor Authentication:</strong>
                            {{ $user->two_factor_enabled ? 'Enabled' : 'Disabled' }}
                        </p>
                    </div>
                </div>

                <!-- Orders -->
                <div class="tab-pane fade" id="orders">
                    <div class="card p-3 rounded-4 shadow-sm">
                        <h5 class="fw-bold mb-3">Recent Orders</h5>
                        @if($user->orders->count())
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Invoice</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->orders->take(5) as $order)
                                        <tr>
                                            <td>{{ $order->invoice_number }}</td>
                                            <td>${{ number_format($order->total, 2) }}</td>
                                            <td><span class="badge bg-info">{{ ucfirst($order->status) }}</span></td>
                                            <td>{{ $order->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted mb-0">No orders found.</p>
                        @endif
                    </div>
                </div>

                <!-- Wishlist -->
                <div class="tab-pane fade" id="wishlist">
                    <div class="card p-3 rounded-4 shadow-sm">
                        <h5 class="fw-bold mb-3">Wishlist Items</h5> @if($user->wishlistItems->count())
                            <ul class="list-group">
                                @foreach($user->wishlistItems as $item)
                                    <li class="list-group-item d-flex align-items-center">
                                        <img src="{{ asset($item->product->main_image ?? '/assets/images/no-image.png') }}"
                                            class="product-thumb me-3" alt="">
                                        {{ $item->product->name }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted mb-0">No wishlist items found.</p>
                        @endif
                    </div>
                </div>

                <!-- Activity Logs -->
                <div class="tab-pane fade" id="activity">
                    <div class="card p-3 rounded-4 shadow-sm">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#001428"
                                    viewBox="0 0 16 16">
                                    <path d="M0 0h1v15h15v1H0z" />
                                    <path d="M2 13h2V8H2v5zm4 0h2V4H6v9zm4 0h2V1h-2v12z" />
                                </svg>
                                User Behavior Analytics
                            </h5>
                            <small class="text-muted">Page visits over time</small>
                        </div>

                        <div id="userBehaviorChart" class="user-chart-card"></div>
                        <h5 class="fw-bold mb-3">Recent Activity</h5>
                        @if($user->activityLogs->count())
                            <table class="table table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>Visited Page</th>
                                        <th>Device</th>
                                        <th>Browser</th>
                                        <th>Location</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->activityLogs->take(10) as $log)
                                        <tr>
                                            <td>{{ $log->page_visited }}</td>
                                            <td>{{ $log->device }}</td>
                                            <td>{{ $log->browser }}</td>
                                            <td>{{ $log->location }}</td>
                                            <td>{{ $log->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">No recent activity logs.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const chartEl = document.querySelector("#userBehaviorChart");
                if (!chartEl) return;

                const labels = @json($pageVisits->pluck('page_visited') ?? []);
            const dataValues = @json($pageVisits->pluck('total') ?? []);

            if (!labels.length || !dataValues.length) {
                chartEl.innerHTML = `
                    <div style="text-align:center; color:#999; padding:60px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" fill="#ccc" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zm3.293 6.707a1 1 0 0 0-1.414-1.414L7 8.172 6.121 7.293a1 1 0 1 0-1.414 1.414l1.707 1.707a1 1 0 0 0 1.414 0l3.465-3.707z"/>
                        </svg>
                        <p style="margin-top:8px;">No analytics data available</p>
                    </div>`;
                return;
            }

            const options = {
                chart: {
                    type: 'bar',
                    height: 360,
                    toolbar: { show: false },
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 900,
                        animateGradually: { enabled: true, delay: 150 },
                        dynamicAnimation: { enabled: true, speed: 450 }
                    },
                    fontFamily: 'Inter, sans-serif'
                },
                series: [{
                    name: 'Page Visits',
                    data: dataValues
                }],
                plotOptions: {
                    bar: {
                        borderRadius: 9,
                        horizontal: false,
                        columnWidth: '55%',
                        distributed: false,
                        endingShape: 'rounded'
                    }
                },
                colors: ['#ff5f0e'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        gradientToColors: ['#001428'],
                        shadeIntensity: 0.6,
                        type: 'vertical',
                        opacityFrom: 0.9,
                        opacityTo: 0.5,
                        stops: [0, 100]
                    }
                },
                dataLabels: { enabled: false },
                xaxis: {
                    categories: labels,
                    labels: {
                        style: { colors: '#001428', fontSize: '13px', fontWeight: 500 },
                        rotate: -15
                    },
                    axisTicks: { show: false },
                    axisBorder: { show: false }
                },
                yaxis: {
                    labels: {
                        style: { colors: '#001428', fontSize: '12px' }
                    },
                    min: 0,
                    tickAmount: 5
                },
                grid: {
                    borderColor: '#f1f1f1',
                    strokeDashArray: 3
                },
                tooltip: {
                    theme: 'dark',
                    y: {
                        formatter: val => `${val} visits`
                    }
                },
                noData: {
                    text: 'No user behavior data found',
                    align: 'center',
                    verticalAlign: 'middle',
                    style: { color: '#999', fontSize: '14px' }
                }
            };

            const chart = new ApexCharts(chartEl, options);
            chart.render();
        });
        </script>

@endsection