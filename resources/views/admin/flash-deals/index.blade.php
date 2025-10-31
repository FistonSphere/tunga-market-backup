@extends('admin.layouts.header')

@section('content')
<div class="flash-deals-container">

    <!-- Header Section -->
    <div class="header-section">
        <h1 class="page-title"><i class="bi bi-lightning-charge-fill"></i> Flash Deals Overview</h1>
        <a href="{{ route('admin.flash-deals.create') }}" class="btn-add">
            <i class="bi bi-plus-circle"></i> Add New Deal
        </a>
    </div>

    <!-- Flash Deals Grid -->
    <div class="deals-grid">
        @forelse ($flashDeals as $deal)
            <div class="deal-card {{ $deal->is_active ? 'active' : 'inactive' }}">
                
                <div class="deal-image">
                    <img src="{{ $deal->product?->main_image ? asset($deal->product->main_image) : asset('assets/images/no-image.png') }}" 
                         alt="{{ $deal->product?->name ?? 'Product' }}">
                    <span class="discount-badge">-{{ $deal->discount_percent ?? 0 }}%</span>
                </div>

                <div class="deal-info">
                    <h3 class="deal-title">{{ $deal->product?->name ?? 'Unnamed Product' }}</h3>
                    <p class="deal-price">
                        <span class="flash-price">Rwf {{ number_format($deal->flash_price, 2) }}</span>
                        <span class="original-price">Rwf {{ number_format($deal->product?->price ?? 0, 2) }}</span>
                    </p>
                    <p class="deal-stock">Stock Limit: {{ $deal->stock_limit ?? '-' }}</p>
                    
                    <div class="deal-timer" data-start="{{ $deal->start_time }}" data-end="{{ $deal->end_time }}">
                        <i class="bi bi-clock-history"></i>
                        <span class="countdown" id="countdown-{{ $deal->id }}">Loading...</span>
                    </div>
                </div>

                <div class="deal-footer">
                    <span class="deal-status {{ $deal->is_active ? 'status-active' : 'status-inactive' }}">
                        {{ $deal->is_active ? 'Active' : 'Inactive' }}
                    </span>
                    <div class="deal-actions">
                        <a href="{{ route('admin.flash-deals.edit', $deal->id) }}" class="btn-edit" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('admin.flash-deals.destroy', $deal->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure to delete this deal?')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" title="Delete">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="no-deals">
                <i class="bi bi-exclamation-circle"></i>
                <p>No flash deals found.</p>
            </div>
        @endforelse
    </div>
</div>


<style>
.flash-deals-container {
    padding: 30px;
    font-family: "Poppins", sans-serif;
    background-color: #fafafa;
}
.header-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}
.page-title {
    font-size: 26px;
    font-weight: 600;
    color: #333;
}
.btn-add {
    background-color: #ff6a00;
    color: #fff;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    transition: 0.3s;
}
.btn-add:hover {
    background-color: #e55d00;
}

/* Grid Layout */
.deals-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
}
.deal-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    overflow: hidden;
    position: relative;
    transition: transform 0.3s ease;
}
.deal-card:hover {
    transform: translateY(-5px);
}

/* Image */
.deal-image {
    position: relative;
    height: 180px;
    overflow: hidden;
}
.deal-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.discount-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    background: #ff3e00;
    color: #fff;
    padding: 5px 10px;
    font-size: 13px;
    border-radius: 20px;
}

/* Info Section */
.deal-info {
    padding: 15px;
}
.deal-title {
    font-size: 17px;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}
.deal-price {
    margin: 8px 0;
}
.flash-price {
    color: #e63900;
    font-weight: bold;
    font-size: 16px;
}
.original-price {
    color: #888;
    text-decoration: line-through;
    margin-left: 10px;
}
.deal-stock {
    font-size: 13px;
    color: #555;
}
.deal-timer {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-top: 10px;
    font-size: 14px;
    color: #444;
}

/* Footer */
.deal-footer {
    border-top: 1px solid #eee;
    padding: 12px 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.status-active {
    background: #e6f7ed;
    color: #2e8b57;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 13px;
}
.status-inactive {
    background: #ffe6e6;
    color: #d32f2f;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 13px;
}
.deal-actions a, .deal-actions button {
    background: transparent;
    border: none;
    cursor: pointer;
    color: #555;
    font-size: 18px;
    margin-left: 8px;
    transition: color 0.3s;
}
.deal-actions a:hover {
    color: #1a73e8;
}
.deal-actions button:hover {
    color: #e60000;
}
.no-deals {
    text-align: center;
    color: #777;
    padding: 40px 0;
    font-size: 16px;
}
</style>

<script>
// Countdown Timer Logic
document.addEventListener("DOMContentLoaded", function () {
    const countdowns = document.querySelectorAll(".countdown");
    countdowns.forEach(cd => {
        const card = cd.closest(".deal-timer");
        const endTime = new Date(card.dataset.end).getTime();

        const updateCountdown = () => {
            const now = new Date().getTime();
            const distance = endTime - now;

            if (distance < 0) {
                cd.textContent = "Expired";
                cd.style.color = "#d32f2f";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            cd.textContent = `${days}d ${hours}h ${minutes}m ${seconds}s`;
        };

        updateCountdown();
        setInterval(updateCountdown, 1000);
    });
});
</script>

@endsection