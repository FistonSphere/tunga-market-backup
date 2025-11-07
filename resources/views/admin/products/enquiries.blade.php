@extends('admin.layouts.header')

@section('content')
    <style>
        /* ==========================================================
                                                                                                                           PRODUCT ENQUIRIES DASHBOARD
                                                                                                                           Modern Pro UI (Alibaba / Ant Design inspired)
                                                                                                                           ========================================================== */

        .enquiries-container {
            padding: 32px 40px;
            background: #f5f7fb;
            min-height: 100vh;
            font-family: "Inter", "Poppins", sans-serif;
            color: #2c3e50;
        }

        /* --- Header Section --- */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 30px;
            gap: 16px;
        }

        .page-header h2 {
            font-size: 1.75rem;
            font-weight: 600;
            color: #222;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .page-header h2 i {
            color: #ff8b00;
            background: rgba(255, 139, 0, 0.1);
            border-radius: 8px;
            padding: 6px;
            font-size: 1.4rem;
        }

        /* --- Filters --- */
        .search-filters form {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .search-input,
        .filter-select {
            padding: 10px 14px;
            border: 1px solid #dcdfe6;
            border-radius: 10px;
            background: #fff;
            font-size: 14px;
            transition: all 0.2s ease;
            box-shadow: 0 0 0 rgba(0, 0, 0, 0);
        }

        .search-input:focus,
        .filter-select:focus {
            border-color: #ff8b00;
            box-shadow: 0 0 0 3px rgba(255, 139, 0, 0.15);
            outline: none;
        }

        /* --- Table Wrapper --- */
        .card-table {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.05);
            overflow-x: auto;
            /* horizontal scroll for small screens */
            scrollbar-width: thin;
            scrollbar-color: #ccc #f9fafc;
        }

        .card-table::-webkit-scrollbar {
            height: 8px;
        }

        .card-table::-webkit-scrollbar-thumb {
            background: #bbb;
            border-radius: 10px;
        }

        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 960px;
            /* ensures scroll on small screens */
        }

        /* --- Table Header --- */
        .table thead {
            background: linear-gradient(90deg, #fafafa, #f3f4f6);
            text-transform: uppercase;
            font-weight: 600;
            font-size: 13px;
            color: #666;
            border-bottom: 1px solid #e0e0e0;
        }

        .table th,
        .table td {
            padding: 16px 20px;
            vertical-align: middle;
            white-space: nowrap;
        }

        .table tbody tr {
            transition: all 0.25s ease;
        }

        .table tbody tr:hover {
            background: #fff9f3;
            box-shadow: 0 3px 10px rgba(255, 139, 0, 0.08);
            transform: translateY(-1px);
        }

        /* --- Product Column --- */
        .product-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .product-thumb {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            border: 1px solid #eee;
            object-fit: cover;
        }

        /* --- Badges --- */
        .badge.bg-secondary {
            background: #e7ebf0 !important;
            color: #2e3a59;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 13px;
        }

        /* --- Contact Column --- */
        .table td i {
            color: #ff8b00;
            margin-right: 6px;
        }

        /* --- Action Buttons --- */
        .btn-action {
            border: none;
            background: #f3f4f6;
            border-radius: 8px;
            padding: 8px 10px;
            transition: all 0.2s ease;
            margin: 0 2px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-action i {
            font-size: 17px;
        }

        .btn-action.view {
            color: #000a2c;
        }

        .btn-action.view:hover {
            background: rgba(0, 123, 255, 0.12);
        }

        .btn-action.delete {
            color: #dc3545;
        }

        .btn-action.delete:hover {
            background: rgba(220, 53, 69, 0.12);
        }

        /* --- Empty State --- */
        .table td.text-center {
            font-size: 15px;
            color: #888;
        }

        .table td.text-center i {
            font-size: 28px;
            color: #ccc;
            display: block;
            margin-bottom: 6px;
        }

        /* --- Pagination --- */
        .pagination-wrapper {
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }

        /* --- Modal --- */
        .modal-content {
            border-radius: 20px !important;
            overflow: hidden;
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            background: linear-gradient(90deg, #ff8b00, #ffb347);
            border: none;
            padding: 16px 24px;
        }

        .modal-header .modal-title {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .modal-body {
            padding: 30px 24px;
            background: #fff;
            font-size: 15px;
            color: #333;
        }

        #enquiryDetails {
            line-height: 1.7;
        }

        #enquiryDetails p {
            margin-bottom: 12px;
            border-bottom: 1px dashed #eee;
            padding-bottom: 6px;
        }

        /* --- Responsive Adjustments --- */
        @media (max-width: 992px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-filters form {
                width: 100%;
            }

            .search-input,
            .filter-select {
                flex: 1;
                min-width: 180px;
            }

            .table th,
            .table td {
                padding: 12px 14px;
            }

            .product-thumb {
                width: 36px;
                height: 36px;
            }
        }

        button.product-btn-filter {
            background: #ff8b00;
            color: #fff;
            border: none;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s ease;
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

        .nav-link {
            color: #f88c10;
        }

        /* ===== Ticket Copy Button ===== */
        .ticket-copy {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            position: relative;
        }

        .copy-btn {
            background: transparent;
            border: none;
            color: #6c757d;
            cursor: pointer;
            padding: 4px;
            border-radius: 6px;
            transition: all 0.2s ease;
            position: relative;
        }

        .copy-btn:hover {
            background: rgba(255, 139, 0, 0.08);
            color: #ff6a13;
        }

        .copy-btn.copied {
            color: #ff6a13 !important;
        }

        .copy-btn i {
            font-size: 15px;
        }

        /* ===== Tooltip (Copied!) ===== */
        .copy-tooltip {
            position: absolute;
            top: -28px;
            right: -4px;
            background: #ff6a13;
            color: #fff;
            font-size: 12px;
            padding: 3px 8px;
            border-radius: 6px;
            opacity: 0;
            transform: translateY(5px);
            animation: fadeInTooltip 0.25s ease forwards;
        }

        @keyframes fadeInTooltip {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .confirm-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(6px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            transform: scale(1.05);
            transition: all 0.3s ease;
        }

        .confirm-modal-overlay.show {
            opacity: 1;
            transform: scale(1);
        }

        .confirm-modal {
            background: #fff;
            border-radius: 14px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            padding: 30px 25px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            transform: translateY(20px);
            animation: slideUp 0.3s ease forwards;
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .confirm-icon {
            margin-bottom: 10px;
            display: flex;
            justify-content: center;
        }

        .confirm-modal h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }

        .confirm-modal p {
            color: #666;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .confirm-actions {
            display: flex;
            justify-content: center;
            gap: 12px;
        }

        .confirm-actions .btn {
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .confirm-actions .btn.cancel {
            background: #f1f1f1;
            color: #333;
        }

        .confirm-actions .btn.cancel:hover {
            background: #e0e0e0;
        }

        .confirm-actions .btn.delete {
            background: #f44336;
            color: #fff;
        }

        .confirm-actions .btn.delete:hover {
            background: #d32f2f;
        }
    </style>
    <div class="enquiries-container">

        <div class="page-header">
            <h2><i class="bi bi-chat-dots text-primary"></i> Product Enquiries</h2>
            <div class="search-filters">
                <form method="GET" action="{{ route('admin.products.enquiriesSearch') }}" class="enquiry-search-form">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by name, ticket, or product..." class="search-input" />

                    <select name="product_id" class="filter-select">
                        <option value="">All Products</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" @selected(request('product_id') == $product->id)>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="product-btn-filter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path
                                d="M6 10a.5.5 0 0 1-.354-.146l-3.5-3.5a.5.5 0 0 1 .708-.708L6 8.293 12.646 1.646a.5.5 0 0 1 .708.708l-7 7A.5.5 0 0 1 6 10z" />
                        </svg>
                        Filter
                    </button>

                    @if(request('search') || request('product_id'))
                        <a href="{{ route('admin.products.enquiriesSearch') }}" class="btn-reset">
                            Reset
                        </a>
                    @endif
                </form>

            </div>
        </div>

        <div class="card-table shadow-sm rounded-4">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Ticket</th>
                        <th>Product</th>
                        <th>Customer</th>
                        <th>Quantity</th>
                        <th>Target Price</th>
                        <th>Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enquiries as $enquiry)
                        <tr>
                            <td>
                                <div class="ticket-copy">
                                    <span class="badge bg-secondary">{{ $enquiry->ticket }}</span>
                                    <button class="copy-btn" onclick="copyTicket('{{ $enquiry->ticket }}', this)"
                                        title="Copy Ticket">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="clipboard-icon" viewBox="0 0 16 16">
                                            <path
                                                d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                                            <path
                                                d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </td>


                            <td>
                                <div class="product-info">
                                    <img src="{{ asset($enquiry->product->main_image ?? asset('/assets/images/no-image.png')) }}"
                                        class="product-thumb" alt="">
                                    <span>{{ Str::limit($enquiry->product->name, 30) }}</span>
                                </div>
                            </td>
                            <td>
                                <strong>{{ $enquiry->name ? $enquiry->name : $enquiry->company }}</strong>
                            </td>
                            <td>{{ $enquiry->quantity }}</td>
                            <td>{{ number_format($enquiry->target_price) }} Rwf</td>
                            <td>{{ $enquiry->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <button class="btn-action" data-bs-toggle="modal" data-bs-target="#replyEnquiryModal"
                                    data-enquiry="{{ $enquiry->toJson() }}">
                                    <i class="bi bi-reply"></i> Reply
                                </button>
                                <button class="btn-action view" data-bs-toggle="modal" data-bs-target="#viewEnquiryModal"
                                    data-enquiry='@json($enquiry)'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-eye" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </button>

                                <form action="{{ route('admin.enquiry.destroy', $enquiry->id) }}" method="POST"
                                    class="d-inline delete-form">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-action delete" onclick="confirmDelete(this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                        </svg>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-inbox" viewBox="0 0 16 16">
                                    <path
                                        d="M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4zm9.954 5H10.45a2.5 2.5 0 0 1-4.9 0H1.066l.32 2.562a.5.5 0 0 0 .497.438h12.234a.5.5 0 0 0 .496-.438zM3.809 3.563A1.5 1.5 0 0 1 4.981 3h6.038a1.5 1.5 0 0 1 1.172.563l3.7 4.625a.5.5 0 0 1 .105.374l-.39 3.124A1.5 1.5 0 0 1 14.117 13H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .106-.374z" />
                                </svg> No enquiries found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($enquiries->hasPages())
            <div class="pagination-container">
                <ul class="pagination-list">
                    {{-- Previous Page Link --}}
                    @if ($enquiries->onFirstPage())
                        <li class="disabled">&laquo;</li>
                    @else
                        <li>
                            <a href="{{ $enquiries->previousPageUrl() }}" rel="prev">&laquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($enquiries->links()->elements[0] ?? [] as $page => $url)
                        @if ($page == $enquiries->currentPage())
                            <li class="active">{{ $page }}</li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($enquiries->hasMorePages())
                        <li>
                            <a href="{{ $enquiries->nextPageUrl() }}" rel="next">&raquo;</a>
                        </li>
                    @else
                        <li class="disabled">&raquo;</li>
                    @endif
                </ul>
            </div>
        @endif
    </div>

    <!-- View Enquiry Modal -->
    <div class="modal fade" id="viewEnquiryModal" tabindex="-1" aria-labelledby="viewEnquiryLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                            <path
                                d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                            <path
                                d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9 9 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.4 10.4 0 0 1-.524 2.318l-.003.011a11 11 0 0 1-.244.637c-.079.186.074.394.273.362a22 22 0 0 0 .693-.125m.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6-3.004 6-7 6a8 8 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a11 11 0 0 0 .398-2" />
                        </svg> Enquiry Details</h5>
                    <button type="button" data-bs-dismiss="modal"
                        style="border-radius: 50%; border: none;background:rgb(230, 6, 6);color:#fff;">&times;</button>
                </div>
                <div class="modal-body p-4">
                    <div id="enquiryDetails"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reply to Enquiry Modal -->
    <div class="modal fade" id="replyEnquiryModal" tabindex="-1" aria-labelledby="replyEnquiryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header bg-light border-0">
                    <h5 class="modal-title fw-bold" style="color: #fff" id="replyEnquiryModalLabel">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-reply-fill" viewBox="0 0 16 16">
                            <path
                                d="M5.921 11.9 1.353 8.62a.72.72 0 0 1 0-1.238L5.921 4.1A.716.716 0 0 1 7 4.719V6c1.5 0 6 0 7 8-2.5-4.5-7-4-7-4v1.281c0 .56-.606.898-1.079.62z" />
                        </svg> Reply to Enquiry
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        style="border-radius: 50%;background-color: #001428;">&times;</button>
                </div>

                <form id="replyEnquiryForm" method="POST" action="{{ route('admin.enquiries.reply') }}">
                    @csrf
                    <input type="hidden" name="enquiry_id" id="replyEnquiryId">

                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <p><strong>Customer:</strong> <span id="enquiryName"></span></p>
                            <p><strong>Product:</strong> <span id="enquiryProduct"></span></p>
                            <p><strong>Email:</strong> <span id="enquiryEmail"></span></p>
                            <p><strong>Phone:</strong> <span id="enquiryPhone"></span></p>
                        </div>

                        <!-- Tabs for Email / SMS -->
                        <ul class="nav nav-tabs mb-3" id="replyTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="email-tab" data-bs-toggle="tab"
                                    data-bs-target="#emailTab" type="button" role="tab">Email Reply</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="sms-tab" data-bs-toggle="tab" data-bs-target="#smsTab"
                                    type="button" role="tab">SMS Reply</button>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <!-- Email Reply -->
                            <div class="tab-pane fade show active" id="emailTab" role="tabpanel">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Subject</label>
                                    <input type="text" class="form-control" name="subject" placeholder="Subject">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email Message</label>
                                    <textarea class="form-control" name="email_message" rows="5"
                                        placeholder="Write your email reply..."></textarea>
                                </div>
                                <div class="alert alert-light border mt-3">
                                    <strong>Preview:</strong>
                                    <div id="emailPreview" class="mt-2 text-muted small">
                                        Your message preview will appear here.
                                    </div>
                                </div>
                            </div>

                            <!-- SMS Reply -->
                            <div class="tab-pane fade" id="smsTab" role="tabpanel">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">SMS Message</label>
                                    <textarea class="form-control" name="sms_message" rows="4" maxlength="320"
                                        placeholder="Write your SMS reply..."></textarea>
                                </div>
                                <div class="alert alert-warning small">
                                    <i class="bi bi-info-circle"></i> SMS should not
                                    exceed 320 characters.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-0 bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-send"></i> Send Reply
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const viewButtons = document.querySelectorAll('[data-bs-target="#viewEnquiryModal"]');
            const modalBody = document.getElementById('enquiryDetails');

            viewButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const enquiry = JSON.parse(btn.dataset.enquiry);
                    modalBody.innerHTML = `
                                                                                                                                                                <h5>${enquiry.name} <small class="text-muted">(${enquiry.company || 'No company'})</small></h5>
                                                                                                                                                                <p><strong>Email:</strong> ${enquiry.email}</p>
                                                                                                                                                                <p><strong>Phone:</strong> ${enquiry.phone}</p>
                                                                                                                                                                <p><strong>Quantity:</strong> ${enquiry.quantity}</p>
                                                                                                                                                                <p><strong>Target Price:</strong> ${enquiry.target_price.toLocaleString()} Rwf</p>
                                                                                                                                                                <p><strong>Message:</strong> ${enquiry.message}</p>
                                                                                                                                                                <hr>
                                                                                                                                                                <p class="text-muted"><i class="bi bi-hash"></i> Ticket: ${enquiry.ticket}</p>
                                                                                                                                                            `;
                });
            });
        });

        function confirmDelete(button) {
            const form = button.closest('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "This enquiry will be permanently deleted.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Yes, delete it'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const replyModal = document.getElementById('replyEnquiryModal');

            replyModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const enquiry = JSON.parse(button.getAttribute('data-enquiry'));

                document.getElementById('replyEnquiryId').value = enquiry.id;
                document.getElementById('enquiryName').textContent = enquiry.name;
                document.getElementById('enquiryProduct').textContent = enquiry.product?.name || 'N/A';
                document.getElementById('enquiryEmail').textContent = enquiry.email;
                document.getElementById('enquiryPhone').textContent = enquiry.phone;

                document.querySelector('[name="subject"]').value = `Response to your enquiry #${enquiry.ticket}`;
            });

            // Live preview for email message
            document.querySelector('[name="email_message"]').addEventListener('input', function () {
                document.getElementById('emailPreview').innerText = this.value || 'Your message preview will appear here.';
            });
        });

        function copyTicket(ticket, btn) {
            navigator.clipboard.writeText(ticket).then(() => {
                // Swap to checkmark icon
                btn.innerHTML = `
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#28a745" class="clipboard-check" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                                                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
                                                </svg>
                                            `;
                btn.classList.add('copied');

                // Show temporary tooltip
                const tooltip = document.createElement('span');
                tooltip.className = 'copy-tooltip';
                tooltip.textContent = 'Copied!';
                btn.appendChild(tooltip);

                setTimeout(() => {
                    tooltip.remove();
                    // revert back to clipboard icon
                    btn.innerHTML = `
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#6c757d" class="clipboard-icon" viewBox="0 0 16 16">
                                                        <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                                                        <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
                                                    </svg>
                                                `;
                    btn.classList.remove('copied');
                }, 1500);
            });
        }

        function confirmDelete(button) {
            const form = button.closest('form');

            // Create overlay
            const modal = document.createElement('div');
            modal.className = 'confirm-modal-overlay';
            modal.innerHTML = `
                            <div class="confirm-modal">
                                <div class="confirm-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-exclamation-diamond-fill" viewBox="0 0 16 16">
              <path d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
            </svg>
                                </div>
                                <h3>Delete this enquiry?</h3>
                                <p>This action cannot be undone. Are you sure you want to proceed?</p>
                                <div class="confirm-actions">
                                    <button class="btn cancel">Cancel</button>
                                    <button class="btn delete">Yes, Delete</button>
                                </div>
                            </div>
                        `;
            document.body.appendChild(modal);

            // Add animations
            setTimeout(() => modal.classList.add('show'), 10);

            // Handle cancel
            modal.querySelector('.cancel').addEventListener('click', () => {
                modal.classList.remove('show');
                setTimeout(() => modal.remove(), 300);
            });

            // Handle delete
            modal.querySelector('.delete').addEventListener('click', () => {
                modal.classList.remove('show');
                setTimeout(() => {
                    modal.remove();
                    form.submit();
                }, 300);
            });
        }
    </script>


@endsection