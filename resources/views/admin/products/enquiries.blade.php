@extends('admin.layouts.header')

@section('content')
    <style>
        /* =======================
           Enquiries Page
           ======================= */
        .enquiries-container {
            padding: 20px;
            background: #f7f9fb;
            min-height: 100vh;
        }

        .header-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .title-group h2 {
            font-size: 22px;
            font-weight: 600;
            color: #333;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .title-group .subtitle {
            font-size: 14px;
            color: #777;
        }

        .actions input {
            padding: 8px 14px;
            border-radius: 6px;
            border: 1px solid #ccc;
            min-width: 250px;
            font-size: 14px;
            transition: 0.2s;
        }

        .actions input:focus {
            border-color: #ff8b00;
            outline: none;
        }

        .enquiries-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
            gap: 18px;
        }

        .enquiry-card {
            background: #fff;
            border-radius: 12px;
            padding: 16px 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: 0.2s;
        }

        .enquiry-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }

        .enquiry-header {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #666;
            margin-bottom: 10px;
        }

        .ticket {
            font-weight: 600;
            color: #ff8b00;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        .product-info img {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
        }

        .enquiry-details p {
            margin: 3px 0;
            font-size: 14px;
        }

        .enquiry-details .message {
            margin-top: 10px;
            font-style: italic;
            color: #444;
        }

        .enquiry-actions {
            margin-top: 15px;
            display: flex;
            gap: 10px;
        }

        .enquiry-actions .btn {
            padding: 6px 14px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            transition: 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .reply-btn {
            background: #ff8b00;
            color: #fff;
        }

        .reply-btn:hover {
            background: #e17b00;
        }

        .delete-btn {
            background: #e0e0e0;
            color: #333;
        }

        .delete-btn:hover {
            background: #d32f2f;
            color: #fff;
        }

        /* Empty State */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 50px 0;
        }

        .empty-state img {
            width: 180px;
            opacity: 0.8;
        }

        .empty-state p {
            margin-top: 15px;
            color: #777;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .enquiries-grid {
                grid-template-columns: 1fr;
            }

            .actions input {
                width: 100%;
                margin-top: 10px;
            }

            .header-section {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
    <div class="enquiries-container">
        <div class="header-section">
            <div class="title-group">
                <h2><i class="bi bi-envelope-paper"></i> Product Enquiries</h2>
                <p class="subtitle">Manage all product enquiries from buyers</p>
            </div>

            <div class="actions">
                <input type="text" id="searchEnquiry" placeholder="Search by ticket, name, or product...">
            </div>
        </div>

        <div class="enquiries-grid">
            @forelse($enquiries as $enquiry)
                <div class="enquiry-card" data-id="{{ $enquiry->id }}">
                    <div class="enquiry-header">
                        <span class="ticket">🎫 {{ $enquiry->ticket }}</span>
                        <span class="date">{{ $enquiry->created_at->format('M d, Y H:i') }}</span>
                    </div>

                    <div class="enquiry-body">
                        <div class="product-info">
                            <img src="{{ $enquiry->product->main_image ?? asset('assets/images/no-image.png') }}" alt="">
                            <div>
                                <h4>{{ $enquiry->product->name }}</h4>
                                <p class="sku">SKU: {{ $enquiry->product->sku ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="enquiry-details">
                            <p><strong>Name:</strong> {{ $enquiry->name }}</p>
                            <p><strong>Company:</strong> {{ $enquiry->company ?? '—' }}</p>
                            <p><strong>Email:</strong> {{ $enquiry->email }}</p>
                            <p><strong>Phone:</strong> {{ $enquiry->phone }}</p>
                            <p><strong>Quantity:</strong> {{ $enquiry->quantity }}</p>
                            <p><strong>Target Price:</strong> {{ number_format($enquiry->target_price) }} Rwf</p>
                            <p class="message"><strong>Message:</strong> {{ $enquiry->message }}</p>
                        </div>
                    </div>

                    <div class="enquiry-actions">
                        <button class="btn reply-btn" onclick="openReplyModal('{{ $enquiry->id }}', '{{ $enquiry->email }}')">
                            <i class="bi bi-reply-fill"></i> Reply
                        </button>
                        <button class="btn delete-btn" onclick="openDeleteModal('{{ $enquiry->id }}')">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <img src="{{ asset('assets/images/empty-state.png') }}" alt="No enquiries">
                    <p>No product enquiries found yet.</p>
                </div>
            @endforelse
        </div>
    </div>

    @include('admin.products.enquiries.modals')
@endsection