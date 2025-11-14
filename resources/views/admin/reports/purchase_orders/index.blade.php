@extends('admin.layouts.header')

@section('content')
    <style>
        .report-card {
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 20px;
            transition: .3s ease;
        }

        .report-card:hover {
            transform: translateY(-3px);
        }

        .stat-box {
            border-radius: 12px;
            padding: 20px;
            background: linear-gradient(135deg, #eef2ff, #e0e7ff);
            text-align: center;
            transition: .3s;
        }

        .stat-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 22px rgba(0, 0, 0, 0.08);
        }

        .stat-value {
            font-size: 1.2rem;
            font-weight: 800;
            color: #111827;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 0.95rem;
            color: #6B7280;
        }

        .filter-card {
            border-radius: 16px;
            background: #f8fafc;
            padding: 20px;
            box-shadow: inset 0 0 0 1px #e2e8f0;
        }

        table tr:hover {
            background: #f1f5f9;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            font-size: 0.8rem;
            font-weight: 700;
            border-radius: 24px;
            text-transform: capitalize;
            letter-spacing: 0.3px;
        }

        /* STATUS COLORS */
        .status-pending {
            background: rgba(250, 204, 21, 0.15);
            /* yellow */
            color: #b45309;
            border: 1px solid rgba(250, 204, 21, 0.25);
        }

        .status-processing {
            background: rgba(59, 130, 246, 0.15);
            /* blue */
            color: #1d4ed8;
            border: 1px solid rgba(59, 130, 246, 0.25);
        }

        .status-delivered {
            background: rgba(16, 185, 129, 0.15);
            /* green */
            color: #047857;
            border: 1px solid rgba(16, 185, 129, 0.25);
        }

        .status-cancelled {
            background: rgba(239, 68, 68, 0.15);
            /* red */
            color: #b91c1c;
            border: 1px solid rgba(239, 68, 68, 0.25);
        }

        .status-refunded {
            background: rgba(139, 92, 246, 0.15);
            /* purple */
            color: #6d28d9;
            border: 1px solid rgba(139, 92, 246, 0.25);
        }

        .status-failed {
            background: rgba(245, 101, 101, 0.15);
            /* red-ish */
            color: #c53030;
            border: 1px solid rgba(245, 101, 101, 0.25);
        }

        /* Responsive scaling */
        @media (max-width: 576px) {
            .status-badge {
                padding: 4px 10px;
                font-size: 0.75rem;
            }
        }


        /* Responsive adjustments */
        @media (max-width: 992px) {

            /* Medium Devices - Tablets */
            .stat-box {
                padding: 20px;
            }

            .stat-value {
                font-size: 1rem;
            }
        }

        @media (max-width: 768px) {

            /* Small Devices - Phones */
            .stat-box {
                padding: 18px;
            }

            .stat-value {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {

            /* Extra Small Phones */
            .stats-row .col-12 {
                margin-bottom: 15px;
            }

            .stat-box {
                padding: 16px;
            }

            .stat-value {
                font-size: 1.4rem;
            }

            .stat-label {
                font-size: 0.85rem;
            }
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

    <div class="container-fluid py-4">

        <h3 class="fw-bold mb-4">📦 Purchase Order Report</h3>

        <!-- Filters -->
        <div class="filter-card mb-4">
            <form action="" method="GET" class="row gy-3">

                <div class="col-md-3">
                    <label class="fw-semibold">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $startDate->format('Y-m-d') }}">
                </div>

                <div class="col-md-3">
                    <label class="fw-semibold">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="{{ $endDate->format('Y-m-d') }}">
                </div>

                <div class="col-md-3">
                    <label class="fw-semibold">Order Status</label>
                    <select name="status" class="form-select">
                        <option value="">All</option>
                        <option value="Pending" {{ $status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Processing" {{ $status == 'Processing' ? 'selected' : '' }}>Processing</option>
                        <option value="Delivered" {{ $status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="Cancelled" {{ $status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="fw-semibold">Payment Method</label>
                    <select name="payment_method" class="form-select">
                        <option value="">All</option>
                        <option value="cash" {{ $paymentMethod == 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="card" {{ $paymentMethod == 'card' ? 'selected' : '' }}>Card</option>
                        <option value="mobile" {{ $paymentMethod == 'mobile' ? 'selected' : '' }}>Mobile Money</option>
                    </select>
                </div>

                <div class="col-md-12 mt-3">
                    <button class="btn btn-primary px-4">Filter</button>
                </div>

            </form>
        </div>

        <!-- Stats -->
        <div class="row stats-row mb-4">
            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="stat-box">
                    <div class="stat-value">{{ $summary['total_orders'] }}</div>
                    <div class="stat-label">Total Orders</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="stat-box">
                    <div class="stat-value">{{ number_format($summary['total_revenue'], 0) }} RWF</div>
                    <div class="stat-label">Total Revenue</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="stat-box">
                    <div class="stat-value">{{ number_format($summary['total_tax'], 0) }}</div>
                    <div class="stat-label">Total Tax Collected</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="stat-box">
                    <div class="stat-value">{{ $summary['delivered_orders'] }}</div>
                    <div class="stat-label">Delivered Orders</div>
                </div>
            </div>
        </div>


        <!-- Orders Table -->
        <div class="report-card">
            <h5 class="fw-bold mb-3">Order Details</h5>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr class="text-uppercase small text-muted">
                            <th>Order ID</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="fw-semibold">{{ $order->invoice_number }}</td>
                                <td>{{ $order->user->name ?? 'Guest' }}</td>
                                <td>{{ number_format($order->total, 0) }} RWF</td>
                                <td>
                                    <span class="status-badge status-{{ strtolower($order->status) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>

                                <td>{{ $order->payment_method }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($orders->hasPages())
                <div class="pagination-container">
                    <ul class="pagination-list">
                        {{-- Previous Page Link --}}
                        @if ($orders->onFirstPage())
                            <li class="disabled">&laquo;</li>
                        @else
                            <li>
                                <a href="{{ $orders->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($orders->links()->elements[0] ?? [] as $page => $url)
                            @if ($page == $orders->currentPage())
                                <li class="active">{{ $page }}</li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($orders->hasMorePages())
                            <li>
                                <a href="{{ $orders->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="disabled">&raquo;</li>
                        @endif
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection