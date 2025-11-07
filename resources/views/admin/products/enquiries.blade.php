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

    .btn-filter {
      background: linear-gradient(90deg, #ff8b00, #ffaf4b);
      color: #fff;
      border: none;
      padding: 10px 18px;
      border-radius: 10px;
      cursor: pointer;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 6px;
      transition: all 0.25s ease;
      box-shadow: 0 4px 12px rgba(255, 139, 0, 0.2);
    }

    .btn-filter:hover {
      background: linear-gradient(90deg, #ff7b00, #ffa73a);
      transform: translateY(-1px);
      box-shadow: 0 6px 14px rgba(255, 139, 0, 0.3);
    }

    /* --- Table Wrapper --- */
    .card-table {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 6px 24px rgba(0, 0, 0, 0.05);
      overflow-x: auto; /* horizontal scroll for small screens */
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
      min-width: 960px; /* ensures scroll on small screens */
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