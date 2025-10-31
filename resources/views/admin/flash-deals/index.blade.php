@extends('admin.layouts.header')

@section('content')
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

        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 9999;
            animation: fadeIn 0.3s ease-in-out;
        }

        .modal-content {
            background: #fff;
            padding: 25px 30px;
            border-radius: 10px;
            width: 400px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            animation: slideUp 0.3s ease-in-out;
        }

        .modal-content h2 {
            margin-bottom: 10px;
            color: #333;
            font-size: 20px;
        }

        .modal-content p {
            font-size: 15px;
            color: #666;
            margin-bottom: 25px;
        }

        .modal-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s ease;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .btn-cancel {
            background-color: #6c757d;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s ease;
        }

        .btn-cancel:hover {
            background-color: #5a6268;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
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
                            <strong>{{ number_format($deal->flash_price) }} Rwf</strong>
                        </div>
                        <div class="row">
                            <span>Discount:</span>
                            <strong class="text-green">{{ $deal->discount_percent}}%</strong>
                        </div>
                        <div class="row">
                            <span>Stock Limit:</span>
                            <strong>{{ $deal->stock_limit ?? '-' }}</strong>
                        </div>

                        <div class="time-info">
                            <small>Start: {{ optional($deal->start_time)->format('d M Y, H:i') ?? '-' }}</small>
                            <small>End: {{ optional($deal->end_time)->format('d M Y, H:i') ?? '-' }}</small>
                        </div>

                        <!-- Use current_status attribute (computed) -->
                        <span class="badge {{ $deal->current_status === 'Active' ? 'badge-active' : 'badge-inactive' }}">
                            {{ $deal->current_status }}
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
                        <button type="submit" class="deleteBtn btn-icon delete" data-id="{{ $deal->id }}"
                            data-name="{{ $deal->product->name ?? 'Unnamed Product'  }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-trash3" viewBox="0 0 16 16">
                                <path
                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                            </svg>
                        </button>
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




    <!-- Delete Modal -->
    <div id="deleteModal" class="modal-overlay" style="display:none;">
        <div class="modal-content">
            <h2>Are you sure?</h2>
            <p id="deleteMessage">This action cannot be undone. Do you really want to delete this category?</p>

            <div class="modal-actions">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Yes, Delete</button>
                </form>
                <button id="cancelDelete" class="btn-cancel">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal-overlay" style="display:none;">
        <div class="modal-content">
            <h2>Are you sure?</h2>
            <p id="deleteMessage">This action cannot be undone. Do you really want to delete this deal?</p>

            <div class="modal-actions">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Yes, Delete</button>
                </form>
                <button id="cancelDelete" class="btn-cancel">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.deleteBtn');
            const deleteModal = document.getElementById('deleteModal');
            const cancelDelete = document.getElementById('cancelDelete');
            const deleteForm = document.getElementById('deleteForm');
            const deleteMessage = document.getElementById('deleteMessage');

            console.log("✅ Delete modal script loaded.");

            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const dealId = this.getAttribute('data-id');
                    const productName = this.getAttribute('data-name');
                    // Update confirmation message
                    deleteMessage.textContent = `Are you sure you want to delete "${productName}" deal?`;

                    // Update form action dynamically
                    deleteForm.action = `/admin/category/${dealId}/delete`;

                    // Show modal
                    deleteModal.style.display = 'flex';
                });
            });

            cancelDelete.addEventListener('click', function () {
                console.log("🟡 Delete canceled.");
                deleteModal.style.display = 'none';
            });

            window.addEventListener('click', function (e) {
                if (e.target === deleteModal) {
                    console.log("🟠 Clicked outside modal, closing.");
                    deleteModal.style.display = 'none';
                }
            });
        });


    </script>
@endsection