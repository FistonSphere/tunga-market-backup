@extends('admin.layouts.header')@section('content')
    <div class="flash-page-container">
        <div class="flash-header">
            <div>
                <h1>Flash Deals Overview</h1>
                <p>Manage limited-time promotional offers for products</p>
            </div>
            <a href="{{ route('admin.flash-deals.create') }}" class="btn-add">
                <i class="bi bi-lightning-charge-fill"></i> Add Flash Deal
            </a>
        </div>

        {{-- Notification --}}
        @if(session('success'))
            <div class="alert alert-success animate-fade-in">
                <strong>Success:</strong> {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-error animate-shake">
                <strong>Error:</strong> {{ session('error') }}
            </div>
        @endif

        <div class="flash-grid" id="flashDealsGrid">
            @forelse($flashDeals as $deal)
                <div class="flash-card">
                    <div class="flash-top">
                        <div class="flash-image">
                            <img src="{{ $deal->product->main_image ?? asset('assets/images/no-image.png') }}"
                                alt="{{ $deal->product->name ?? 'Product' }}">
                        </div>
                        <div class="flash-info">
                            <h3>{{ $deal->product->name ?? 'Unnamed Product' }}</h3>
                            <p>{{ $deal->product->category->name ?? 'Uncategorized' }}</p>
                        </div>
                    </div>

                    <div class="flash-body">
                        <div class="row">
                            <span>Flash Price:</span>
                            <strong>${{ number_format($deal->flash_price, 2) }}</strong>
                        </div>
                        <div class="row">
                            <span>Discount:</span>
                            <strong class="text-green">{{ $deal->discount_percent ?? 0 }}%</strong>
                        </div>
                        <div class="row">
                            <span>Stock Limit:</span>
                            <strong>{{ $deal->stock_limit ?? '-' }}</strong>
                        </div>

                        <div class="time-info">
                            <small>Start: {{ optional($deal->start_time)->format('d M Y, H:i') ?? '-' }}</small>
                            <small>End: {{ optional($deal->end_time)->format('d M Y, H:i') ?? '-' }}</small>
                        </div>

                        <span class="badge {{ $deal->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ $deal->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>

                    <div class="flash-footer">
                        <a href="{{ route('admin.flash-deals.edit', $deal->id) }}" class="btn-icon edit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg>
                        </a>
                        <form action="{{ route('admin.flash-deals.destroy', $deal->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this flash deal?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="no-data">
                    <i class="bi bi-lightning-charge"></i>
                    <p>No flash deals available yet.</p>
                    <a href="{{ route('admin.flash-deals.create') }}" class="btn-add">Create Flash Deal</a>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        /* =============================
               Flash Deals Overview Styling
            ============================= */
        .flash-page-container {
            padding: 30px;
            background: #f8f9fc;
            min-height: 100vh;
        }

        /* Header Section */
        .flash-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .flash-header h1 {
            font-size: 26px;
            color: #222;
            margin-bottom: 5px;
        }

        .flash-header p {
            color: #666;
            font-size: 14px;
        }

        .btn-add {
            background-color: #f97316;
            color: #fff;
            padding: 10px 18px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 2px 6px rgba(249, 115, 22, 0.3);
        }

        .btn-add i {
            margin-right: 6px;
        }

        .btn-add:hover {
            background-color: #ea580c;
            transform: translateY(-2px);
        }

        /* Alerts */
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .alert-success {
            background: #e7f9ed;
            color: #256d3b;
            border: 1px solid #a7e0b2;
        }

        .alert-error {
            background: #fde8e8;
            color: #a11;
            border: 1px solid #f5b5b5;
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease;
        }

        .animate-shake {
            animation: shake 0.6s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-8px);
            }

            40%,
            80% {
                transform: translateX(8px);
            }
        }

        /* Grid Layout */
        .flash-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 25px;
        }

        /* Flash Deal Card */
        .flash-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .flash-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        /* Card Top */
        .flash-top {
            display: flex;
            align-items: center;
            padding: 15px 18px;
            border-bottom: 1px solid #eee;
        }

        .flash-image {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            overflow: hidden;
            margin-right: 15px;
        }

        .flash-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .flash-info h3 {
            margin: 0;
            font-size: 17px;
            color: #222;
        }

        .flash-info p {
            margin: 4px 0 0;
            color: #777;
            font-size: 13px;
        }

        /* Body Info */
        .flash-body {
            padding: 15px 18px;
            position: relative;
        }

        .flash-body .row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin: 6px 0;
            color: #555;
        }

        .text-green {
            color: #22c55e;
        }

        .time-info {
            margin-top: 10px;
            font-size: 12px;
            color: #888;
            display: flex;
            justify-content: space-between;
        }

        .badge {
            position: absolute;
            top: 15px;
            right: 18px;
            padding: 3px 10px;
            font-size: 11px;
            border-radius: 50px;
            font-weight: 600;
        }

        .badge-active {
            background: #dcfce7;
            color: #166534;
        }

        .badge-inactive {
            background: #f3f4f6;
            color: #555;
        }

        /* Footer Buttons */
        .flash-footer {
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            padding: 10px 14px;
            gap: 10px;
        }

        .btn-icon {
            border: none;
            background: none;
            cursor: pointer;
            font-size: 18px;
            padding: 6px;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .btn-icon.edit {
            color: #2563eb;
        }

        .btn-icon.delete {
            color: #dc2626;
        }

        .btn-icon:hover {
            background: #f3f4f6;
            transform: scale(1.1);
        }

        /* Empty State */
        .no-data {
            text-align: center;
            padding: 80px 20px;
            color: #777;
        }

        .no-data i {
            font-size: 48px;
            color: #f97316;
            display: block;
            margin-bottom: 10px;
        }

        .no-data p {
            font-size: 16px;
            margin-bottom: 10px;
        }
    </style>
@endsection