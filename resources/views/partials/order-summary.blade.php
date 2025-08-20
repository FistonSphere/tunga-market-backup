<!-- Order Summary -->
<div class="card" id="order-summary">
    <h3 class="font-semibold text-primary mb-4">Order Summary</h3>

    <div class="space-y-3 text-body-sm">
        <div class="flex justify-between">
            <span class="text-secondary-600">
                Subtotal (<span id="summary-total-items">{{ $totalItems }}</span>
                {{ Str::plural('item', $totalItems) }}):
            </span>
            <span class="font-medium text-primary" id="summary-subtotal">
                {{ number_format($subtotal, 2) }} Rwf
            </span>
        </div>
        <div class="flex justify-between">
            <span class="text-secondary-600">Bulk Discount:</span>
            <span id="summary-discount"
                class="font-medium {{ $bulkDiscount > 0 ? 'text-success' : 'text-secondary-500' }}">
                -{{ number_format($bulkDiscount, 2) }} Rwf
            </span>
        </div>
        <div class="flex justify-between">
            <span class="text-secondary-600">Tax (estimated):</span>
            <span class="font-medium text-primary" id="summary-tax">
                {{ number_format($tax, 2) }} Rwf
            </span>
        </div>
        <div class="border-t border-border pt-3">
            <div class="flex justify-between">
                <span class="font-semibold text-primary">Total:</span>
                <span class="text-xl font-bold text-primary" id="summary-total">
                    {{ number_format($total, 2) }} Rwf
                </span>
            </div>
            <div id="summary-save-message"
                class="text-success text-body-sm mt-1 {{ $bulkDiscount <= 0 ? 'hidden' : '' }}">
                You save {{ number_format($bulkDiscount, 2) }} Rwf with bulk pricing!
            </div>
        </div>
    </div>

    <!-- Checkout Button -->
    @auth
        <form action="{{ route('checkout.index') }}" method="GET" class="mt-6">
            <button class="btn-primary w-full">Proceed to Checkout</button>
        </form>
    @else
        <div
            class="flex flex-col items-center justify-center mt-6 bg-gradient-to-br from-secondary-50 to-primary-50 rounded-xl p-6 border border-primary/20 shadow-lg animate-fade-in">
            <div class="relative mb-3">
                <svg class="w-12 h-12 text-primary drop-shadow" fill="none" stroke="currentColor" stroke-width="2.2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span
                    class="absolute -top-2 -right-2 bg-accent text-white text-xs px-2 py-0.5 rounded-full shadow">Guest</span>
            </div>
            <p class="text-body text-center text-secondary-800 mb-3 font-medium">
                <span class="inline-block animate-bounce mr-1">👋</span>
                <span>Welcome! Please <span class="text-primary font-semibold">log in</span> to complete your order.</span>
            </p>
            <a href="{{ route('login') }}"
                class="btn-primary w-full max-w-xs font-semibold transition-transform hover:scale-105 focus:ring-2 focus:ring-primary/50">
                Log in to Checkout
            </a>

        </div>

    @endauth

    <!-- Payment Options -->
    <div class="mt-4">
        <div class="text-body-sm text-secondary-600 mb-3">We accept:</div>
        <div class="flex items-center space-x-3">
            <div class="w-10 h-6 bg-primary rounded text-white text-xs flex items-center justify-center font-bold">
                VISA
            </div>
            <div class="w-10 h-6 bg-accent rounded text-white text-xs flex items-center justify-center font-bold">
                MC
            </div>
            <div class="w-10 h-6 bg-secondary rounded text-white text-xs flex items-center justify-center font-bold">
                PP
            </div>
            <div class="text-body-sm text-secondary-600">+ more</div>
        </div>
    </div>
</div>
