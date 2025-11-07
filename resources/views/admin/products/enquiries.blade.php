@extends('admin.layouts.header')

@section('content')
    {{-- <style>
        .enquiries-container {
            padding: 20px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-header h2 {
            font-weight: 600;
        }

        .search-filters {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .search-input,
        .filter-select {
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .btn-filter {
            background-color: #2563eb;
            color: #fff;
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-filter:hover {
            background-color: #1e40af;
        }

        .card-table {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead th {
            font-weight: 600;
            color: #333;
            background: #f9fafb;
        }

        .table td {
            vertical-align: middle;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .product-thumb {
            width: 40px;
            height: 40px;
            border-radius: 6px;
            object-fit: cover;
        }

        .btn-action {
            background: none;
            border: none;
            padding: 5px 8px;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .btn-action.view:hover {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .btn-action.delete:hover {
            background: #fee2e2;
            color: #dc2626;
        }

        .badge {
            font-size: 0.8rem;
            border-radius: 8px;
            padding: 4px 10px;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
        }

        .modal-content {
            border-radius: 14px !important;
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-body p {
            margin-bottom: 8px;
        }
    </style> --}}

    <style>
        /* ==============================
       PRODUCT ENQUIRIES PAGE
       Inspired by Alibaba Dashboard UI
       ============================== */

        /* === Container Layout === */
        .enquiries-container {
            padding: 30px 40px;
            background: #f9fafc;
            min-height: 100vh;
            font-family: "Inter", "Segoe UI", sans-serif;
        }

        /* === Header & Filters === */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-header h2 {
            font-size: 1.6rem;
            color: #333;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .page-header h2 i {
            color: #ff8b00;
            font-size: 1.5rem;
        }

        .search-filters form {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .search-input {
            padding: 8px 12px;
            border: 1px solid #d6d9dc;
            border-radius: 8px;
            min-width: 240px;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .search-input:focus {
            border-color: #ff8b00;
            outline: none;
        }

        .filter-select {
            padding: 8px 10px;
            border-radius: 8px;
            border: 1px solid #d6d9dc;
            background: #fff;
            font-size: 14px;
        }

        .btn-filter {
            background: #ff8b00;
            color: #fff;
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.2s;
        }

        .btn-filter:hover {
            background: #e67e00;
        }

        /* === Table Styling === */
        .card-table {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #eee;
        }

        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 14px;
            color: #333;
        }

        .table thead {
            background: #f5f7fa;
            text-transform: uppercase;
            font-weight: 600;
            font-size: 13px;
        }

        .table th,
        .table td {
            padding: 14px 18px;
            vertical-align: middle;
            border-bottom: 1px solid #eee;
        }

        .table th {
            color: #666;
        }

        .table tbody tr:hover {
            background: #fafafa;
        }

        /* === Product Info Column === */
        .product-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .product-thumb {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        /* === Badges === */
        .badge.bg-secondary {
            background: #dfe3e8 !important;
            color: #333;
            font-weight: 500;
            padding: 6px 10px;
            border-radius: 6px;
        }

        /* === Action Buttons === */
        .btn-action {
            background: none;
            border: none;
            padding: 6px 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-action i {
            font-size: 16px;
        }

        .btn-action.view {
            color: #007bff;
        }

        .btn-action.view:hover {
            background: rgba(0, 123, 255, 0.1);
        }

        .btn-action.delete {
            color: #dc3545;
        }

        .btn-action.delete:hover {
            background: rgba(220, 53, 69, 0.1);
        }

        /* === Pagination === */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 25px;
        }

        /* === Empty State === */
        .table td.text-center i {
            font-size: 28px;
            color: #ccc;
        }

        /* === Modal Design === */
        .modal-content {
            border-radius: 16px !important;
            overflow: hidden;
            border: none;
        }

        .modal-header {
            background: linear-gradient(90deg, #ff8b00, #ffb347);
            border: none;
            color: #fff;
            border-radius: 16px 16px 0 0 !important;
        }

        .modal-header .modal-title {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .modal-body {
            background: #fff;
            font-size: 14px;
            color: #444;
        }

        #enquiryDetails {
            line-height: 1.6;
        }

        #enquiryDetails p {
            margin-bottom: 10px;
        }

        /* === Responsiveness === */
        @media (max-width: 992px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-filters form {
                width: 100%;
            }

            .search-input {
                flex: 1;
            }

            .table th,
            .table td {
                padding: 10px 12px;
            }

            .product-thumb {
                width: 32px;
                height: 32px;
            }
        }
    </style>
    <div class="enquiries-container">

        <div class="page-header">
            <h2><i class="bi bi-chat-dots text-primary"></i> Product Enquiries</h2>
            <div class="search-filters">
                <form method="GET" action="{{ route('admin.products.enquiriesIndex') }}">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by name, ticket, or product..." class="search-input">
                    <select name="product_id" class="filter-select">
                        <option value="">All Products</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" @selected(request('product_id') == $product->id)>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn-filter"><i class="bi bi-funnel"></i> Filter</button>
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
                        <th>Contact</th>
                        <th>Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enquiries as $enquiry)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $enquiry->ticket }}</span></td>
                            <td>
                                <div class="product-info">
                                    <img src="{{ asset($enquiry->product->main_image ?? asset('/assets/images/no-image.png')) }}"
                                        class="product-thumb" alt="">
                                    <span>{{ Str::limit($enquiry->product->name, 30) }}</span>
                                </div>
                            </td>
                            <td>
                                <strong>{{ $enquiry->name }}</strong><br>
                                <small class="text-muted">{{ $enquiry->company ?? '—' }}</small>
                            </td>
                            <td>{{ $enquiry->quantity }}</td>
                            <td>${{ number_format($enquiry->target_price, 2) }}</td>
                            <td>
                                <i class="bi bi-envelope"></i> {{ $enquiry->email }}<br>
                                <i class="bi bi-telephone"></i> {{ $enquiry->phone }}
                            </td>
                            <td>{{ $enquiry->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <button class="btn-action view" data-bs-toggle="modal" data-bs-target="#viewEnquiryModal"
                                    data-enquiry='@json($enquiry)'>
                                    <i class="bi bi-eye"></i>
                                </button>

                                <form action="{{ route('admin.enquiry.destroy', $enquiry->id) }}" method="POST"
                                    class="d-inline delete-form">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn-action delete" onclick="confirmDelete(this)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="bi bi-inbox"></i> No enquiries found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper mt-4">
            {{ $enquiries->links() }}
        </div>
    </div>

    <!-- View Enquiry Modal -->
    <div class="modal fade" id="viewEnquiryModal" tabindex="-1" aria-labelledby="viewEnquiryLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="bi bi-chat-dots"></i> Enquiry Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="enquiryDetails"></div>
                </div>
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
                                        <p><strong>Target Price:</strong> $${enquiry.target_price}</p>
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
    </script>


@endsection