@extends('admin.layouts.header')

@section('content')

<!-- Modern UI Interactions -->
    <style>
        .hover-lift:hover {
            transform: translateY(-4px);
            transition: all 0.2s ease-in-out;
        }

        .hover-scale:hover {
            transform: scale(1.03);
            transition: all 0.2s ease-in-out;
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .bg-gradient-light {
            background: linear-gradient(135deg, #f9fafb, #eef2ff);
        }
    </style>
    
    <div class="container-fluid px-5 py-5 bg-slate-50 min-vh-100">

        <!-- Breadcrumb & Actions -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1 text-gray-800">🔔 Notification Details</h4>
                <p class="text-muted small mb-0">Stay informed with every important platform activity</p>
            </div>
            <a href="{{ route('admin.notifications.index') }}"
                class="btn btn-light border rounded-pill px-3 shadow-sm hover-scale">
                ← Back to Notifications
            </a>
        </div>

        <!-- Main Card -->
        <div class="card border-0 shadow-lg rounded-4 p-4 fade-in">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="fw-bold text-dark mb-2">
                        {{ $notification->title }}
                    </h3>
                    <span
                        class="badge {{ $notification->is_read ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} px-3 py-2 rounded-pill">
                        {{ $notification->is_read ? 'Read' : 'Unread' }}
                    </span>
                </div>
                <div class="text-muted small">
                    {{ $notification->created_at->format('M d, Y - H:i A') }}
                </div>
            </div>

            <hr class="my-4">

            <!-- Message -->
            <div class="p-3 bg-gradient-light rounded-3 border-start border-4 border-primary-subtle shadow-sm">
                <p class="mb-0 fs-5 text-gray-700">
                    {{ $notification->message }}
                </p>
            </div>

            <!-- Meta Data Section -->
            @if(!empty($notification->data))
                <div class="mt-5">
                    <h5 class="fw-bold text-gray-700 mb-3">📋 Additional Details</h5>

                    <div class="row g-3">
                        @foreach($notification->data as $key => $value)
                            <div class="col-md-6 col-lg-4">
                                <div class="info-card shadow-sm rounded-3 p-3 bg-white border border-gray-100 hover-lift">
                                    <div class="text-muted small text-uppercase fw-semibold">
                                        {{ Str::title(str_replace('_', ' ', $key)) }}</div>
                                    <div class="fw-bold text-dark mt-1">
                                        @if(is_array($value))
                                            <pre
                                                class="small bg-light p-2 rounded mb-0">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                                        @else
                                            {{ $value }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Insights Panel -->
            <div class="mt-5">
                <h5 class="fw-bold text-gray-700 mb-3">📊 Action Insights</h5>
                <div id="notificationInsightChart" style="height: 250px;"></div>
            </div>

        </div>
    </div>

    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const chartOptions = {
                chart: {
                    type: 'radialBar',
                    height: 250,
                    sparkline: { enabled: true },
                },
                series: [{{ $notification->is_read ? 100 : 40 }}],
                labels: ['Engagement'],
                plotOptions: {
                    radialBar: {
                        hollow: { size: '70%' },
                        track: { background: '#f1f5f9' },
                        dataLabels: {
                            name: { offsetY: -10, color: '#6b7280', fontSize: '14px' },
                            value: { color: '#111827', fontSize: '20px', fontWeight: 'bold' },
                        }
                    }
                },
                colors: ['#2563eb'],
                fill: { type: 'gradient', gradient: { shade: 'light', gradientToColors: ['#60a5fa'], stops: [0, 100] } },
            };
            const chart = new ApexCharts(document.querySelector("#notificationInsightChart"), chartOptions);
            chart.render();
        });
    </script>

    
@endsection