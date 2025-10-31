@extends('admin.layouts.header')

@section('content')
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
@endsection