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
            background: white;
            border-radius: 16px;
            padding: 22px;
            text-align: center;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05);
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .stat-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 22px rgba(0, 0, 0, 0.08);
        }

        .stat-value {
            font-size: 1.7rem;
            font-weight: 700;
            color: #1e40af;
        }

        .stat-label {
            font-size: .9rem;
            color: #475569;
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
                                    <span class="badge text-bg-primary">{{ $order->status }}</span>
                                </td>
                                <td>{{ $order->payment_method }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $orders->links() }}
        </div>
    </div>
@endsection