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
            color: #007bff;
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
                    <button type="submit" class="product-btn-filter"><i class="bi bi-funnel"></i> Filter</button>
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
                                <strong>{{ $enquiry->name ?? $enquiry->company}}</strong>
                            </td>
                            <td>{{ $enquiry->quantity }}</td>
                            <td>{{ number_format($enquiry->target_price) }} Rwf</td>
                            <td>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-envelope" viewBox="0 0 16 16">
                                    <path
                                        d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                                </svg> {{ $enquiry->email }}<br>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-telephone" viewBox="0 0 16 16">
                                    <path
                                        d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                                </svg> {{ $enquiry->phone }}
                            </td>
                            <td>{{ $enquiry->created_at->format('d M Y') }}</td>
                            <td class="text-center">
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
                                            class="bi bi-trash" viewBox="0 0 16 16">
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

        <div class="pagination-wrapper mt-4">
            {{ $enquiries->links() }}
        </div>
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
                    <button type="button" data-bs-dismiss="modal" style="border-radius: 50%; border: none;background:rgb(230, 6, 6);color:#fff;">&times;</button>
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
    </script>


@endsection