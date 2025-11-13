@extends('admin.layouts.header')

@section('content')
    <style>
        /* --- Layout --- */
        .dashboard-container {
            background: #f9fafb;
            min-height: 100vh;
            padding: 2rem 1.5rem;
            font-family: "Inter", "Poppins", sans-serif;
        }

        /* --- Header --- */
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .dashboard-header h4 {
            font-weight: 700;
            color: #1e293b;
        }

        /* --- Stats Cards --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff, #f0f4ff);
            border-radius: 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            transition: 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        }

        .stat-title {
            font-size: 0.9rem;
            color: #64748b;
        }

        .stat-value {
            font-size: 1.6rem;
            font-weight: 700;
            color: #1e3a8a;
        }

        .stat-growth {
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 0.4rem;
        }

        .stat-growth.up {
            color: #16a34a;
        }

        .stat-growth.down {
            color: #dc2626;
        }

        /* --- Chart Card --- */
        .chart-card {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .chart-card h5 {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1rem;
        }

        /* --- Notification List --- */
        .notification-card {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .notification-item {
            border-left: 4px solid transparent;
            padding: 1rem 1.25rem;
            transition: all 0.25s ease;
        }

        .notification-item.unread {
            background: #f0f9ff;
            border-left: 4px solid #2563eb;
        }

        .notification-item:hover {
            background: #f8fafc;
            border-left: 4px solid #3b82f6;
        }

        .notification-item strong {
            color: #0f172a;
        }

        .notification-time {
            font-size: 0.8rem;
            color: #94a3b8;
        }

        .notification-badge {
            background: linear-gradient(90deg, #ef4444, #dc2626);
            color: #fff;
            border-radius: 20px;
            padding: 0.3rem 0.7rem;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* --- Empty state --- */
        .notification-empty {
            text-align: center;
            color: #94a3b8;
            padding: 3rem 1rem;
        }


        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .pagination-list {
            display: flex;
            list-style: none;
            padding: 0;
            gap: 8px;
            background: #fff;
            border-radius: 8px;
            padding: 8px 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            font-family: "Segoe UI", sans-serif;
        }

        .pagination-list li {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .pagination-list li a {
            text-decoration: none;
            color: #444;
            padding: 8px 12px;
            border-radius: 6px;
            display: inline-block;
            transition: all 0.25s ease;
        }

        .pagination-list li a:hover {
            background-color: #ff6b00;
            color: #fff;
            box-shadow: 0 3px 6px rgba(255, 107, 0, 0.25);
            transform: translateY(-2px);
        }

        .pagination-list li.active {
            background-color: #ff6b00;
            color: #fff;
            box-shadow: 0 3px 6px rgba(255, 107, 0, 0.3);
            pointer-events: none;
        }

        .pagination-list li.disabled {
            color: #ccc;
            opacity: 0.6;
            cursor: not-allowed;
        }

        .pagination-list li.disabled:hover {
            transform: none;
            box-shadow: none;
        }
    </style>

    <div class="dashboard-container">
        <div class="dashboard-header">
            <h4>📊 Notifications Analytics</h4>
            <form action="{{ route('admin.notifications.markAllAsRead') }}" method="POST" id="markAllForm">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill">
                    <i class="bi bi-check2-all"></i> Mark All as Read
                </button>
            </form>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-title">Last 7 Days</div>
                <div class="stat-value">{{ $stats['weekly'] ?? 0 }}</div>
                <div class="stat-growth {{ ($growth['weekly'] ?? 0) >= 0 ? 'up' : 'down' }}">
                    {{ ($growth['weekly'] ?? 0) >= 0 ? '+' : '' }}{{ $growth['weekly'] ?? 0 }}%
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Last 28 Days</div>
                <div class="stat-value">{{ $stats['monthly'] ?? 0 }}</div>
                <div class="stat-growth {{ ($growth['monthly'] ?? 0) >= 0 ? 'up' : 'down' }}">
                    {{ ($growth['monthly'] ?? 0) >= 0 ? '+' : '' }}{{ $growth['monthly'] ?? 0 }}%
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-title">This Year</div>
                <div class="stat-value">{{ $stats['yearly'] ?? 0 }}</div>
                <div class="stat-growth {{ ($growth['yearly'] ?? 0) >= 0 ? 'up' : 'down' }}">
                    {{ ($growth['yearly'] ?? 0) >= 0 ? '+' : '' }}{{ $growth['yearly'] ?? 0 }}%
                </div>
            </div>
        </div>

        <!-- Chart Visualization -->
        <div class="chart-card">
            <h5>📈 Notification Volume (Last 30 Days)</h5>
            <canvas id="notificationsChart" height="100"></canvas>
        </div>

        <!-- Notifications List -->
        <div class="notification-card">
            <ul class="list-group list-group-flush">
                @forelse($notifications as $noti)
                    <li class="list-group-item notification-item {{ !$noti->is_read ? 'unread' : '' }}">
                        <a href="{{ route('admin.notifications.show', $noti->id) }}"
                            class="d-flex justify-content-between align-items-center text-decoration-none text-dark">
                            <div>
                                <strong>{{ $noti->title }}</strong>
                                <p class="mb-1">{{ Str::limit($noti->message, 100) }}</p>
                                <span class="notification-time">{{ $noti->created_at->diffForHumans() }}</span>
                            </div>
                            @if(!$noti->is_read)
                                <span class="notification-badge">New</span>
                            @endif
                        </a>
                    </li>
                @empty
                    <li class="list-group-item notification-empty">
                        <i class="bi bi-bell-slash fs-3 d-block mb-2"></i>
                        No notifications found.
                    </li>
                @endforelse
            </ul>
        </div>

        @if ($notifications->hasPages())
            <div class="pagination-container">
                <ul class="pagination-list">
                    {{-- Previous Page Link --}}
                    @if ($notifications->onFirstPage())
                        <li class="disabled">&laquo;</li>
                    @else
                        <li>
                            <a href="{{ $notifications->previousPageUrl() }}" rel="prev">&laquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($notifications->links()->elements[0] ?? [] as $page => $url)
                        @if ($page == $notifications->currentPage())
                            <li class="active">{{ $page }}</li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($notifications->hasMorePages())
                        <li>
                            <a href="{{ $notifications->nextPageUrl() }}" rel="next">&raquo;</a>
                        </li>
                    @else
                        <li class="disabled">&raquo;</li>
                    @endif
                </ul>
            </div>
        @endif
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('notificationsChart');
        const chartData = @json($chartData);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.map(d => d.date),
                datasets: [{
                    label: 'Notifications',
                    data: chartData.map(d => d.count),
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#2563eb',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    x: { grid: { display: false } },
                    y: { grid: { color: '#f1f5f9' }, ticks: { stepSize: 1 } }
                }
            }
        });
    </script>

    <script>
        document.getElementById('markAllForm').addEventListener('submit', async function (e) {
            e.preventDefault();
            const res = await fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            const data = await res.json();
            if (data.status === 'success') location.reload();
        });
    </script>

@endsection