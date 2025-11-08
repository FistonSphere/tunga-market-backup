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

        .custom-tabs .nav-link {
            border: none;
            color: #555;
            padding: 10px 20px;
            font-weight: 500;
        }

        .custom-tabs .nav-link.active {
            color: #001428;
            border-bottom: 2px solid #001428;
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
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card bg-light border-0 shadow-sm rounded-4 p-3">
                    <h6>Total Orders</h6>
                    <h3>{{ $user->orders->count() }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card bg-light border-0 shadow-sm rounded-4 p-3">
                    <h6>Wishlist Items</h6>
                    <h3>{{ $user->wishlistItems->count() }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card bg-light border-0 shadow-sm rounded-4 p-3">
                    <h6>Platform Rating</h6>
                    <h3>⭐ {{ number_format($user->platform_rating, 1) }}/5</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card bg-light border-0 shadow-sm rounded-4 p-3">
                    <h6>Activity Logs</h6>
                    <h3>{{ $user->activityLogs->count() }}</h3>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs custom-tabs mb-3" id="userTabs" role="tablist">
            <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab"
                    data-bs-target="#overview">Overview</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#orders">Orders</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#wishlist">Wishlist</button>
            </li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#activity">Activity
                    Logs</button></li>
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
                    <h5 class="fw-bold mb-3">Wishlist Items</h5>
                    @if($user->wishlistItems->count())
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

                    <canvas id="userBehaviorChart" height="120"></canvas>
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


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('userBehaviorChart');
            if (!ctx) return;

            const labels = @json($pageVisits->pluck('page_visited'));
            const dataValues = @json($pageVisits->pluck('total'));

            const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 200);
            gradient.addColorStop(0, 'rgba(13,110,253,0.8)');
            gradient.addColorStop(1, 'rgba(13,110,253,0.2)');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Visits',
                        data: dataValues,
                        backgroundColor: gradient,
                        borderRadius: 6,
                        borderSkipped: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#111',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            padding: 10,
                            cornerRadius: 8
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: {
                                color: '#666',
                                font: { size: 13 }
                            }
                        },
                        y: {
                            grid: { color: '#eee' },
                            ticks: {
                                color: '#666',
                                font: { size: 12 },
                                stepSize: 1
                            }
                        }
                    },
                    animation: {
                        duration: 1200,
                        easing: 'easeOutQuart'
                    }
                }
            });
        });
    </script>

@endsection